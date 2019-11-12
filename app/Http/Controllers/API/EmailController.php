<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\SendRecipe;
use App\Mail\Notify;
use App\Mail\Welcome;
use Mail;

class EmailController extends Controller
{
    //
    public function index()
    {
        return response()->json(['success' => 1]);
    }

    public function create()
    {
        //
    }
// Request $request
    public function store(Request $request)
    // public function store()
    {
        /**
	     * Store a newly created resource in storage.
	     *
	     * @param  \Illuminate\Http\Request  $request
	     * @return \Illuminate\Http\Response
	     */

        $email = $request->email;
        $recipe = $request->recipe;
        Mail::to($email)->send(new SendRecipe($recipe));

        return response()->json(['success' => true, 'email' => $email]);
    }
		
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}