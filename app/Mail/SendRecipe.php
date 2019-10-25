<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendRecipe extends Mailable
{
    use Queueable, SerializesModels;

    public $recipe;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($recipe, $user)
    {
        //Pass the data along to the view
        $this->recipe = $recipe;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.SendRecipe');
    }
}
