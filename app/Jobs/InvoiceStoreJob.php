<?php

namespace App\Jobs;

use App\Http\Action\Invoice\StoreInvoice;
use App\Models\Invoices;
use App\Models\Orders;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class InvoiceStoreJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Orders $order;
    protected User $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Orders $order, User $user)
    {
        $this->order = $order;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        (new StoreInvoice())->handle($this->order, $this->user);
    }
}
