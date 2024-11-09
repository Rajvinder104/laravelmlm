<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;

use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Contracts\Queue\ShouldQueue;

class Composemail extends Mailable
{
    use Queueable, SerializesModels;
    public $request;
    public $subject;
    /**
     * Create a new message instance.
     */
    public function __construct($request, $subject)
    {
        $this->request = $request;
        $this->subject = $subject;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: $this->subject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.email',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    // public function attachments(): array
    // {
    //     $attachment = [];

    //     if ($this->subject) {
    //         $attachment = [
    //             Attachment::fromPath(public_path('/uploads/' . $this->subject)),
    //         ];
    //     }

    //     return $attachment;
    // }
}
