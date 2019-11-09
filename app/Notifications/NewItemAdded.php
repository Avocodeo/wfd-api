<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class NewItemAdded extends Notification
{
    use Queueable;

    //public $mail_title;
    //$mail_title = "New Item Added";
    //public $mail_message = "Someone added a new item to your inventory! You should login and check it out :^)";

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
    public function via($notifiable)
    {
        return ['database'];
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
                    ->subject("New Item Added")
                    ->line("Someone added a new item to your inventory! You should login and check it out :^)")
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
        return 'A new item has been added to your inventory';
    }
}