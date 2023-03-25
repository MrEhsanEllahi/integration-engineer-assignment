<?php

namespace App\Http\Controllers;

use App\Helpers\GeneralHelper;
use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Subscriber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Integrations\MailerLite\MailerLiteManager;

class SubscribersController extends Controller
{
    public function lsit()
    {
        
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'email' => 'required|email',
            'country' => 'required|string'
        ]);

        if ($validator->fails()) {
            $notification = ['message' => $validator->errors()->first(), 'alert-type' => 'error'];
            return redirect()->back()->with($notification)->withInput();
        }

        try {
            $apiToken = GeneralHelper::getApiToken();
            
            if(!$apiToken) {
                $notification = ['message' => 'Integration not found', 'alert-type' => 'error'];
            }
            
            if(Subscriber::where('email', $request->email)->exists()) {
                $notification = ['message' => 'User already exist as a subscriber', 'alert-type' => 'error'];
                return redirect()->back()->with($notification)->withInput();
            }
            
            $mailerLiteManager = new MailerLiteManager;
            $subscriber = ['name' => trim($request->name), 'email' => $request->email, 'country' => $request->country];
            $mailerLiteManager->addSubscriber($apiToken, $subscriber);

            $notification = ['message' => 'Subscriber added successfully!', 'alert-type' => 'success'];
            return redirect()->route('home')->with($notification);
        } catch (Exception $e) {
            $notification = ['message' => $e->getMessage(), 'alert-type' => 'error'];
            return redirect()->back()->with($notification)->withInput();
        }
    }
}
