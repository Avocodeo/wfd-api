<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notifiable;
use App\Notifications; 

class NotificationsController extends Controller
{
    use Notifiable;

    public function index()
    {
        if (auth()->check()) {
            return Notifications::
                with('user')
                ->where('notifiable_id', auth()->user()->id)->get();
        }
    }

    public function show()
    {
        return view('notifications.show');
    }
}
