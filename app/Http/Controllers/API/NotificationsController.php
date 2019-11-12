<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;

class NotificationsController extends Controller
{
    public function index()
    {
        return Notification::all();
    }

    public function show(Notification $notification)
    {
        return $notification;
    }

    public function create()
    {
        return view('notifications.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'body' => 'required',
        ]);

        $notification = Notification::create($attributes);
        return response()->json([
            'id' => $notification->id,
            'message' => 'Notification was successfully created'
        ]);
    }


    public function destroy(Notification $notification)
    {
        $notification->delete();

        return response()->json([
            'message' => 'notification was successfully deleted'
        ]);
    }
}
