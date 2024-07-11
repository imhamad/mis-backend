<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $contactData = [];

    public function __construct($data)
    {
        $this->contactData = $data;
    }

    public function build()
    {
        return $this->subject('Contact Us Email')
                ->markdown('emails.contact-email');
    }
}
