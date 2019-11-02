<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

use App\Notifications;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;




class NotificationsController extends Controller
{

    use Notifiable;


    public function index()
    {
        //Get the current user
        $user = \Auth::user();

        //Return all notifications for this user
        return $user->notifications->all();
    }

    public function show(Notifications $notifiable)
    {
        //Get the current user
        $user = \Auth::user();

        //Return all notifications for this user
        return $user->notifications->all();
    }

    public function create()
    {
        return view('notifications.create');
    }
    
    public function destroy(Notifications $notifiable)
    {
        $notifiable->delete();

        return response()->json([
            'message' => 'notification was successfully deleted'
        ]);
    }
}