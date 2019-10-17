<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;

class ApplicationStatusController extends Controller
{
    public function show()
    {
        return response('Application is working !');
    }
}
