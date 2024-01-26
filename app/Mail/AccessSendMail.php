<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AccessSendMail extends Mailable
{
    use Queueable, SerializesModels;

    private $sendMail;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->sendMail = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.approvedAccountMail')
            ->with('data', $this->sendMail);

//        return $this->from('info@chronogrid.com')->subject('mySyte')
//            ->view('mail.mail_send_password', ['password'=>$this->sendMail['password'], 'email'=>$this->sendMail['email']]);
    }
}
