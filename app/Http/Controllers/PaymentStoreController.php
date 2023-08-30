<?php

namespace App\Http\Controllers;

use App\Http\Action\Invoice\StoreInvoice;
use App\Http\Action\Payment\VerificationPaymentAction;
use App\Jobs\CommandMailJob;
use App\Jobs\InvoiceMailJob;
use App\Jobs\InvoiceStoreJob;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;


class PaymentStoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Orders $order
     *
     * @throws IncompletePayment
     * @throws ApiErrorException
     */

    public function __invoke(Request $request, Orders $order)
    {
        if (!Gate::allows('payment', $order['id'])) {
            abort(403);
        }
        $user = Auth::user();
        $user->createOrGetStripeCustomer();
        $pm_last_four = $request->card['last4'];
        $pm_type = $request->card['brand'];
        $user->pm_last_four = $pm_last_four;
        $user->pm_type = $pm_type;
        $user->save();
        $idMethod = $request->id;
        $payment = (new VerificationPaymentAction())->handle($order, $user, $idMethod);

        if ($payment->status === "succeeded") {
            $order->status = $payment->status;
            $order->save();
            CommandMailJob::dispatch($order)->delay(now());
            InvoiceStoreJob::dispatch($order, $user)->delay(now()->addMinutes(1));
            InvoiceMailJob::dispatch($order, $user)->delay(now()->addMinutes(2));

            return response()->json([
                "status" => $payment->status,
                "url" => env('VITE_APP_URL') . '/commandes/' . $order->id . '/response',
            ]);
        } else if ($payment->status === "requires_action") {
            return response()->json([
                "status" => $payment->status,
                "message" => "requires_action",
                "url" => $payment->next_action->redirect_to_url->url,
            ]);
        } else {
            $order->status = "failed";
            $order->save();
            return response()->json([
                "status" => $payment->status,
                "url" => env('VITE_APP_URL') . '/commandes/' . $order->id . '/response',
            ]);
        }

    }
}
