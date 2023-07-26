<?php

namespace App\Http\Action\Payment;

use App\Models\Orders;
use App\Models\User;
use Laravel\Cashier\Exceptions\IncompletePayment;

class VerificationPaymentAction
{
    /**
     * @throws IncompletePayment
     */
    public function handle(Orders $order, User $user, string $idMethod): \Laravel\Cashier\Payment
    {
        $total_price = (float)$order->total_price; // Convertit la chaîne de caractères en nombre flottant
        $total_price_cents = number_format($total_price * 100, 0, '', ''); // Multiplie le montant par 100 et supprime les séparateurs de milliers et décimaux
        return $user->charge($total_price_cents, $idMethod);
    }
}
