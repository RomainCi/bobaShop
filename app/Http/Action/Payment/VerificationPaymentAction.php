<?php

namespace App\Http\Action\Payment;

use App\Models\Orders;
use App\Models\User;
use Laravel\Cashier\Exceptions\IncompletePayment;
use Stripe\Exception\CardException;

class VerificationPaymentAction
{
    /**
     * @throws IncompletePayment
     */
    public function handle(Orders $order, User $user, string $idMethod)
    {
        $total_price = (float)$order->total_price;
        $total_price_cents = number_format($total_price * 100, 0, '', '');
        try {
            return $user->charge($total_price_cents, $idMethod, [
                'return_url' => route('requires_action',['id' => $order->id]),
            ]);

        } catch (IncompletePayment $exception) {
            return $exception->payment;
        } catch (CardException $e) {
            $response = [
                "status" => $e->getError()->code,
                "message" => $e->getMessage(),
            ];
            return json_decode(json_encode($response));
        } catch (\Exception $e) {
            dd($e);
            // Gérer toutes les autres exceptions générales
            $response = [
                "status" => "error",
                "message" => "Une erreur s'est produite lors de l'achat.",
                "error_message" => $e->getMessage(),
                "error_code" => $e->getCode(),
            ];
            return json_decode(json_encode($response));
        }
    }
}
