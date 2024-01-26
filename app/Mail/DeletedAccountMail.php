<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DeletedAccountMail extends Mailable
{
    use Queueable, SerializesModels;

    private $sendMail;

    /**
     * Create a new message instance.
     *
     * @return void
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
        return $this->markdown('emails.deletedAccountMail')
            ->from('hello@chronogrid.com')
            ->with('data', $this->sendMail);

//        return $this->from('info@chronogrid.com')->subject('mySyte')
//            ->view('mail.reset_password_code');
    }
}
