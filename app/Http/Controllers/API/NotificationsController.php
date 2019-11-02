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

    public function show(Notifications $notifiable)
    {
        //Return all notifications for this user
        return $notifiable;
    }

    public function store()
    {
        /*
        Need to create a trigger of some kind. Something that can be submitted with the
        post request that can then be sorted out here. Like it a "1" was sent, that
        could mean that this notification should be "NewItemAdded"

        1 - NewItemAdded
        2 - LowInventory
        3 - NewUser
        4 - OverCapacityInventory
        */

        $attributes = request()->validate([
            'id' => 'required',
        ]);

        //Get all users
        $users = User::all();

        //Send every user a notification
        foreach($user as &$users){
            if($attributes == "1"){
                $user->notify(new NewItemAdded);
            }
            if($attributes == "2"){
                $user->notify(new LowInventory);
            }
            if($attributes == "3"){
                $user->notify(new NewUser);
            }
            if($attributes == "4"){
                $user->notify(new OverCapacityInventory);
            }
        }

        return response()->json([
            'user' => $user,
            'message' => 'Notification has been sent'
        ]);
    }
    
    public function destroy(Notifications $notifiable)
    {
        $notifiable->delete();

        return response()->json([
            'message' => 'notification was successfully deleted'
        ]);
    }
}