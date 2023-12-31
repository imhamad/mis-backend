<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RecoverAccountEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp_code, $user_name;

    public function __construct($otp_code, $user_name)
    {
        $this->otp_code = $otp_code;
        $this->user_name = $user_name;
    }

    public function build()
    {
        return $this->subject('🔐 Password Reset Request')->markdown('emails.recoveraccountemail');
    }
}
