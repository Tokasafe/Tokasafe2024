<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendDemoMail extends Mailable
{
    use Queueable, SerializesModels;
    use Queueable, SerializesModels;
    public $description;
    public $assignTo;
    public $also_assignTo;
    public $real_id;
    public $statusER;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($description, $assignTo, $also_assignToName, $real_id, $statusER)
    {
        $this->description = $description;
        $this->assignTo = $assignTo;
        $this->also_assignTo = $also_assignToName;
        $this->real_id = $real_id;
        $this->statusER = $statusER;
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function envelope()
    {
        return new Envelope(
            subject: 'Event Report Manager',
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
            markdown: 'emails.sendDemoMail',
            with: [
                'description' => $this->description,
                'url' => $this->real_id,
                'assignTo' => $this->assignTo,
                'also_assignTo' => $this->also_assignTo,
                'statusER' => $this->statusER,
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
