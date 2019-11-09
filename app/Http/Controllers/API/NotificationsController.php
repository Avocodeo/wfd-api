<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
    
use App\Notifications;
use App\User;
use Illuminate\Support\Facades\Auth; //Needed to pull current logged in user
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB; //Needed for raw DB queries

//Notification Documentation: https://laravel.com/docs/5.8/notifications#marking-notifications-as-read
//https://www.itsolutionstuff.com/post/laravel-57-new-notification-system-tutorial-for-beginnerexample.html


class NotificationsController extends Controller
{

    use Notifiable;

    public function index()
    {
        if (auth()->check()) {
            return Notifications::where('notifiable_id', auth()->id()->get());
        }
        return Notifications::all();
    }

    public function show(Notifications $notifiable, Request $request)
    {

        /* https://laravel.com/docs/5.4/authentication#retrieving-the-authenticated-user

        use Illuminate\Support\Facades\Auth;

        // Get the currently authenticated user...
        $user = Auth::user();

        // Get the currently authenticated user's ID...
        $id = Auth::id();


        -------------------------

        use Illuminate\Http\Request;

        $request->user() returns an instance of the authenticated user...


        */

        //Return all notifications for this user
        //$users = User::all();
        //$users = auth()->user();
        //return $users->notification;
        //return $notifiable;

        //$user = \App\User::find(1);
        //$notifications = $user->notifications();
        //return $notifications;

        //Get the current User ID
        $id = Auth::id();

        //Get the current User
        $user = Auth::user();
        //$user = $request->user();

        //Since we are returning all notifications for this particular user, we can mark them all as read now.
        //foreach ($users->unreadNotifications as $notification) {
        //$notification->markAsRead();
        //}

        //$user->unreadNotifications()->update(['read_at' => now()]);
        //Raw Query for the DB
        //$user = DB::table('users')->where('name', $id)->first();

        //Need to send response in JSON format.
        return response()->json([
            'id' => $id,
            'user' => $user,
            'userNotifications' => Notifications::where('notifiable_id', $id),
            'AllNotifications' => Notifications::all(),
        ]);
        //return $userId;



        //Okay, this works. Now we just need to filter the request.
        //return Notifications::all();

        //Send request for notifications with this user ID
        //return $userNotifications;
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

        // $attributes = request()->validate([
        //     'id' => 'required',
        // ]);

        Notification::send(auth()->user()->get(), new NewItemAdded);

        // //Send every user a notification
        // if ($attributes == "1") {
        //     $user->notify(new NewItemAdded);
        // }
        // if ($attributes == "2") {
        //     $user->notify(new LowInventory);
        // }
        // if ($attributes == "3") {
        //     $user->notify(new NewUser);
        // }
        // if ($attributes == "4") {
        //     $user->notify(new OverCapacityInventory);
        // }

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