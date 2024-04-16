<?php

namespace App\Listeners;

use App\Events\UserRegistered;
use App\Notifications\NewUserNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendWelcomingMessage
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  UserRegistered  $event
     * @return void
     */
    public function handle(UserRegistered $event)
    {
        $user = $event->user;
        $message['welcome'] = "Welcome {$user->username}";
        $message['thanks'] = "Thanks for joining us. We hope you enjoy the application";
        $user->notify(new NewUserNotification($message));
    }
}
