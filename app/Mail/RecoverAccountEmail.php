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

    public function envelope()
    {
        return new Envelope(
            subject: 'Recover Account Email',
        );
    }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    public function content()
    {
        return new Content(
            markdown: 'recoveraccountemail',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    public function attachments()
    {
        return [];
    }
}
