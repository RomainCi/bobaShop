<?php

namespace App\Jobs;

use App\Mail\BufferUpdateEmailMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BufferUpdateEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected string $email;
    protected string $token;
    protected int $id;

    /**
     * Create a new job instance.
     * @param string $email
     * @param string $token
     * @param int $id
     * @return void
     */
    public function __construct(string $token, string $email,int $id)
    {
        $this->token = $token;
        $this->email = $email;
        $this->id = $id;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        \Mail::to($this->email)
            ->send(New BufferUpdateEmailMail($this->token, $this->id));
    }
}
