<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ModeratorEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $description;
    public $url;
    public $status;
    public $moderator;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($description, $url, $status, $moderator)
    {
        $this->description = $description;
        $this->url = $url;
        $this->status = $status;
        $this->moderator = $moderator;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->description,
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
            markdown: 'emails.moderator-email',
            with: [

                'url' => $this->url,
                'statusER' => $this->status,
                'moderator' => $this->moderator,
            ],
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
