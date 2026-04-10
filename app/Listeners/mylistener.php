<?php

namespace App\Listeners;

use App\Events\myevent;
use App\Mail\welcomeMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class mylistener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(myevent $event): void
    {
    //  Mail::to($event->user->email)->send(new welcomeMail($event->user));

    }
}
