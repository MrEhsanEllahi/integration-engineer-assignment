<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;

class MainController extends Controller
{
    /**
     * Show add-subscriber form
    */
    public function index()
    {
        $countries = Country::all(['name']);
        return view('index', compact('countries'));
    }
}
