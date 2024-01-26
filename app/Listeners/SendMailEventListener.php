<?php

namespace App\Listeners;

use App\Events\MailProcessed;
use App\Events\SendMailEvent;
use App\Mail\UserEventMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendMailEventListener  implements  ShouldQueue
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
     * @param SendMailEvent $event
     */
    public function handle(SendMailEvent $event)
    {
        $model = new UserEventMail($event->details);
        Mail::to($event->details['email'])->send($model);
    }
}
