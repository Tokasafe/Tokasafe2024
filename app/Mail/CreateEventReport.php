<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class CreateEventReport extends Mailable
{
    use Queueable, SerializesModels;
    public $name;
    public $statusER;
    public $url;
    public $occupation;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user, $statusER, $url, $occupation)
    {
        $this->name = $user;
        $this->statusER = $statusER;
        $this->url = $url;
        $this->occupation = $occupation;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->occupation
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
            markdown: 'emails.CreateEventReport',
            with: [
                'name' => $this->name,
                'statusER' => $this->statusER,
                'url' => $this->url,

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
