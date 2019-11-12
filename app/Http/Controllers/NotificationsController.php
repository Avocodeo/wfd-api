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
            'name' => 'required',
            'abbreviation' => 'required',
            'type_id' => 'sometimes'
        ]);

        $notification = Notification::create($attributes);
        return response()->json([
            'id' => $notification->id,
            'message' => 'measurement was successfully created'
        ]);
    }

    public function update(Notification $measurement)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'abbreviation' => 'required',
            'type_id' => 'sometimes'
        ]);

        $measurement->update($attributes);

        return response()->json([
            'measurement' => $measurement->name,
            'message' => 'measurement updated'
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
