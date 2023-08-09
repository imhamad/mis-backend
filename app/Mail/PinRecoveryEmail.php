<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PinRecoveryEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $pin_code;


    public function __construct($email, $pin_code)
    {
        $this->email = $email;
        $this->pin_code = $pin_code;
    }

    /**
     * Get the message envelope.
     */
    public function build()
    {
        return $this->subject('PIN Recovery Mail')->view('emails.pin-recovery-email');
    }
}
