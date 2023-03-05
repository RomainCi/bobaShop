<?php

namespace App\Jobs;

use App\Mail\BufferUsersMail;
use App\Models\BufferUsers;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class BufferUsersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var string $token
     * @var  User $user
     */
    protected User $user;
    protected string $token;

    /**
     * Create a new job instance.
     *
     * @param string $token
     * @param User $user
     * @return void
     */
    public function __construct(User $user, string $token)
    {
        $this->user = $user;
        $this->token = $token;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(): void
    {
        \Mail::to($this->user->email)
            ->send(new BufferUsersMail($this->token, $this->user->lastname, $this->user->id));
    }
}
