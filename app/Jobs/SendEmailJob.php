<?php

namespace App\Jobs;

use App\Notifications\NewUserNotification;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $user;
    public function __construct($blogUser)
    {
        $this->user = $blogUser;
    }
    

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $user = $this->user;
        $message['welcome'] = "Welcome {$user->username}";
        $message['thanks'] = "Thanks for joining us. We hope you enjoy the application";
        $user->notify(new NewUserNotification($message));
        // Mail::to($this->user->email)->send(new WelcomeEmail($this->user))->log();
    }
}
