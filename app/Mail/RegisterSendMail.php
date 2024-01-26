<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\ErrorLog;

class RegisterSendMail extends Mailable
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
        try {
            $log = $this->markdown('emails.newRegisterMail')
                ->with('maildata', $this->sendMail);

            ErrorLog::create([
                'complete' => $log
            ]);
        } catch (\Throwable $th) {
            ErrorLog::create([
                'log' => $th
            ]);
        }
    }
}
