<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\Users_token;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;


class BufferUpdateEmailDeleteJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected int $id;
    protected string $email;

    /**
     * Create a new job instance.
     *
     * @param int $id
     * @param string $email
     */
    public function __construct(int $id, string $email)
    {
        $this->id = $id;
        $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        $user = User::with('tokenMany')->findOrFail($this->id);
        if($user['email'] !== $this->email){
            if ($user->tokenMany) {
                $user->tokenMany->each(function($token) {
                    $token->delete();
                });
            }
        }
    }
}
