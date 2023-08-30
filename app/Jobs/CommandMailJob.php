<?php

namespace App\Jobs;

use App\Mail\CommandMailMail;
use App\Models\Orders;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CommandMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Orders $orders;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Orders $orders)
    {
        $this->orders = $orders;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to("command@boba-shop.fr")
            ->send(New CommandMailMail($this->orders));
    }
}
