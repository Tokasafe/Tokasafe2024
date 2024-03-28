<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ToERM extends Notification
{
    use Queueable;
    public $offerData;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($offerData)
    {
      
        $this->offerData = $offerData;
        
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
        ->greeting($this->offerData['name'])
        ->subject($this->offerData['subject'])
        ->line($this->offerData['body2'])
        ->line($this->offerData['body'])
        ->action($this->offerData['offerText'], $this->offerData['offerUrl'])
        ->line($this->offerData['thanks']);
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
            'offer_id' => $this->offerData['offer_id'],
            'offerUrl' =>$this->offerData['offerUrl'],
            'lookup_name' =>$this->offerData['name'],
            'reference' =>$this->offerData['offerText'],
            'info' =>$this->offerData['body'],
            'bahaya' =>$this->offerData['name']
        ];
    }
}
