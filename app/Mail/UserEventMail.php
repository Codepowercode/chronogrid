<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserEventMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var
     */
    public $sendMail;


    /**
     * UserEventMail constructor.
     * @param $sendMail
     */
    public function __construct($sendMail)
    {
        $this->sendMail = $sendMail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.userEventMail')
            ->with('maildata', $this->sendMail);

//        return $this->from('info@chronogrid.com')->subject('mySyte')
//            ->view('mail.testEmail');

    }
}
