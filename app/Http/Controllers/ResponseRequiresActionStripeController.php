<?php

namespace App\Http\Controllers;

use App\Jobs\CommandMailJob;
use App\Jobs\InvoiceMailJob;
use App\Jobs\InvoiceStoreJob;
use App\Models\Orders;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\Factory;
use phpDocumentor\Reflection\Types\Integer;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;

class ResponseRequiresActionStripeController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param Request $request
     *
     * @throws ApiErrorException
     */
    public function __invoke(Request $request, int $id): Factory|View|Application
    {
        if (!Gate::allows('response', $id)) {
            abort(404);
        }
        Stripe::setApiKey(env('STRIPE_SECRET'));
        $user = Auth::user();
        $order = Orders::find($id);

        $res = [
            "message" => "refusé",
            "price" => $order->total_price,
            "status" => $order->status,
        ];

        if ($order->status === "succeeded") {
            $res["message"] = "accepté";
            return view('ResponseStripeView', compact('res','id'));
        } else if ($order->status === "failed") {
            return view('ResponseStripeView', compact('res','id'));
        } else {
            $paymentIntentId = $request->input('payment_intent');

            if ($paymentIntentId === null) {
                abort(404);
            }

            $paymentIntent = \Stripe\PaymentIntent::retrieve($paymentIntentId);

            if ($paymentIntent->status === "succeeded") {
                $order->status = $paymentIntent->status;
                $order->save();

                CommandMailJob::dispatch($order)->delay(now());
                InvoiceStoreJob::dispatch($order, $user)->delay(now()->addMinutes(1));
                InvoiceMailJob::dispatch($order, $user)->delay(now()->addMinutes(2));

                $res["message"] = "paiement accepté";
            } else {
                $order->status = "failed";
                $order->save();
            }
        }

        return view('ResponseStripeView', compact('res','id'));
    }

}
