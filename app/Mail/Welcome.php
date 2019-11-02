<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\User;

class Welcome extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        //Pass the user data along to the view
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        /*
        
        //Send new user Welcome email
        $this->markdown('emails.Welcome');

        //Notify admin that new user has registered
        dd(User::all()->where('isAdmin', '1')->get());
        $wfd_admin = User::all()->where('isAdmin', '1')->get();
        
        return $wfd_admin->notify(new NewUser);
        */
        
        return $this->markdown('emails.Welcome');
    }
}
