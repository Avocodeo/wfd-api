<?php

namespace App\Http\Controllers;

class ApplicationStatusController extends Controller
{
    public function show()
    {
        return response('Application is working !');
    }
}
