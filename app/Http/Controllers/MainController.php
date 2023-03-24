<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;

class MainController extends Controller
{
    //show the form
    public function index()
    {
        return view('index');
    }
}
