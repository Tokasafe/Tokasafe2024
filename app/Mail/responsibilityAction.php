<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class responsibilityAction extends Mailable
{
    use Queueable, SerializesModels;
    public $responsibility,$followup_action,$url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($responsibility,$followup_action,$url)
    {
        $this->responsibility=$responsibility;
        $this->followup_action=$followup_action;
        $this->url=$url;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: $this->followup_action
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
            markdown: 'emails.responsibilityAction',
            with: [
                'name' => $this->responsibility,
                'url' => $this->url,
                'followup_action' => $this->followup_action,

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
