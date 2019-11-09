<?php

namespace App\Http\Controllers;

use Illuminate\Notifications\Notifiable;
use App\Notifications;
use App\Notifications\LowInventory;
use App\Notifications\NewUser;
use App\Notifications\OverCapacityInventory;

class NotificationsController extends Controller
{
    use Notifiable;

    public function index()
    {
        if (auth()->check()) {
            return Notifications::with('user')
                ->where('notifiable_id', auth()->user()->id)->get();
        }
    }

    public function show()
    {
        return view('notifications.show');
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

        if (auth()->check()) {
            Notification::send(auth()->user()->get(), new NewItemAdded);
        }


        //Send every user a notification
        if ($attributes == "1") {
            if (auth()->check()) {
                Notification::send(auth()->user()->get(), new NewItemAdded);
            }
        }
        if ($attributes == "2") {
            if (auth()->check()) {
                Notification::send(auth()->user()->get(), new LowInventory);
            }
        }
        if ($attributes == "3") {
            if (auth()->check()) {
                Notification::send(auth()->user()->get(), new NewUser);
            }
        }
        if ($attributes == "4") {
            if (auth()->check()) {
                Notification::send(auth()->user()->get(), new OverCapacityInventory);
            }
        }

        return response()->json([
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
