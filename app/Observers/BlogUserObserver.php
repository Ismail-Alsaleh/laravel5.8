<?php

namespace App\Observers;

use App\Models\BlogUser;
use Illuminate\Support\Facades\Log;

class BlogUserObserver
{
    /**
     * Handle the blog user "created" event.
     *
     * @param  \App\BlogUser  $blogUser
     * @return void
     */
    public function created(BlogUser $blogUser)
    {
        $message = "New User Created ".$blogUser->email;
        Log::channel('blogUsers')->info($message);
    }

    /**
     * Handle the blog user "updated" event.
     *
     * @param  \App\BlogUser  $blogUser
     * @return void
     */
    public function updated(BlogUser $blogUser)
    {
        //
    }

    /**
     * Handle the blog user "deleted" event.
     *
     * @param  \App\BlogUser  $blogUser
     * @return void
     */
    public function deleted(BlogUser $blogUser)
    {
        //
    }

    /**
     * Handle the blog user "restored" event.
     *
     * @param  \App\BlogUser  $blogUser
     * @return void
     */
    public function restored(BlogUser $blogUser)
    {
        //
    }

    /**
     * Handle the blog user "force deleted" event.
     *
     * @param  \App\BlogUser  $blogUser
     * @return void
     */
    public function forceDeleted(BlogUser $blogUser)
    {
        //
    }
}
