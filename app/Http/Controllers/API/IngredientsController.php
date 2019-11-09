<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Ingredient;
use App\Notifications\NewItemAdded;


//Trying to get notifications to work
use App\Notifications;
use Notification;
use App\User;
//use \Auth;
use Illuminate\Support\Facades\Auth; //May need this to use auth() ???????



class IngredientsController extends Controller
{
    public function index()
    {
        return Ingredient::all();
    }

    public function show(Ingredient $ingredient)
    {
        return $ingredient;
    }

    public function create()
    {
        return view('ingredients.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required',
            'measurement_id' => 'required',
        ]);

        $ingredient = Ingredient::create($attributes);

        //Get current user
        //$user = $auth->user();
        //$user = \Auth::user();
        //$user = User::all();
        //$user = \User::all();
        //$user = Auth::user();
        //$user = auth();
        
        //spit out this user for debugging
        //dd($user);

        //Send this user a notification
        //$user->notify(new NewItemAdded);
        //$test = \App\User::all()
        //$users = User::whereIn(request()->users)->get();
        $users = \App\User::all();
        Notification::send($users, new NewItemAdded);

        return response()->json([
            'id' => $ingredient->id,
            'message' => 'ingredient was successfully created'
        ]);
    }

    public function update(Ingredient $ingredient)
    {
        $attributes = request()->validate([
            'name' => 'required',
            'measurement_id' => 'sometimes'
        ]);

        $ingredient->update($attributes);

        return response()->json([
            'ingredient' => $ingredient->name,
            'message' => 'ingredient updated'
        ]);
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->delete();

        return response()->json([
            'message' => 'ingredient was successfully deleted'
        ]);
    }
}
