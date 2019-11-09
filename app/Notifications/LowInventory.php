<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class LowInventory extends Notification
{
    use Queueable;

    public $mail_title = "Low Inventory";
    public $mail_message = "An item in your inventory has been seen below the set threshold, in other words: you're running out. We've gone ahead and added this to your shopping list!";

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    //This is how this notification is going to be sent. What channels are used.
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->subject($mail_title)
                    ->line($mail_message)
                    ->action('Check your Notifications', url('/notifications'))
                    ->line('-The WFD Team');
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
            //
            'title' => $mail_title,
            'message' => $mail_message,
        ];
    }
}