<?php

namespace App\Http\Action\Invoice;


use App\Models\Invoices;
use App\Models\Orders;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class StoreInvoice
{
    public function handle(Orders $order, User $user): void
    {
        $date = Carbon::now();
        $date->setTimezone('Europe/Paris');
        $formattedDate = $date->format('d/m/Y');
        $invoiceNumber = $date->format('dmY') . '-' . uniqid();
        $path = 'invoice/' . $user->lastname . '/' . $invoiceNumber . '.pdf';
        Invoices::create([
            "path" => $path,
            "number" => $invoiceNumber,
            "orders_id" => $order->id,
            "users_id" => $order->user->id,
        ]);
        $pdf = Pdf::loadView('pdf.InvoicePdfView', compact('order','user','formattedDate'));
        $pdfString = $pdf->output();
        Storage::disk('s3')->put($path, $pdfString);
    }
}
