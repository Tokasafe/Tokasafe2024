<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ToSupervisor extends Notification
{
    use Queueable;
    public $offerDataSpv;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offerDataSpv)
    {
        $this->offerDataSpv = $offerDataSpv;   
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
        ->greeting($this->offerDataSpv['name'])
        ->subject($this->offerDataSpv['subject'])
        ->line($this->offerDataSpv['body'])
        ->action($this->offerDataSpv['offerText'], $this->offerDataSpv['offerUrl'])
        ->line($this->offerDataSpv['thanks']);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'offer_id' => $this->offerDataSpv['offer_id'],
            'offerUrl' =>$this->offerDataSpv['offerUrl'],
            'lookup_name' =>$this->offerDataSpv['name'],
            'reference' =>$this->offerDataSpv['offerText'],
            'info' =>$this->offerDataSpv['body'],
            'bahaya' =>$this->offerDataSpv['name']
        ];
    }
}
