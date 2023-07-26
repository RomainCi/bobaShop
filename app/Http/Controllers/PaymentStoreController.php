<?php

namespace App\Http\Controllers;

use App\Http\Action\Invoice\StoreInvoice;
use App\Http\Action\Payment\VerificationPaymentAction;
use App\Jobs\InvoiceMailJob;
use App\Jobs\InvoiceStoreJob;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Laravel\Cashier\Exceptions\IncompletePayment;


class PaymentStoreController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param Orders $order
     *
     * @throws IncompletePayment
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
            $order->status = "succeed";
            $order->save();
            InvoiceStoreJob::dispatch($order,$user)->delay(now()->addMinutes(1));
//            $invoice = (new StoreInvoice())->handle($order, $user);
            InvoiceMailJob::dispatch($order, $user)->delay(now()->addMinutes(2));
            return response()->json('success');
        }

    }
}
