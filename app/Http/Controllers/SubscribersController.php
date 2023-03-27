<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Subscriber;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Integrations\MailerLite\MailerLiteManager;

class SubscribersController extends Controller
{
    public function index()
    {
        return view('subscribers.list');
    }

    public function list(Request $request) 
    {
        try {
            $cursor = $request->get('cursor', null);
            $limit = $request->get('limit', 10);
            $draw = $request->get('draw', 1);
            
            $mailerLiteManager = new MailerLiteManager;
            $subscribers = $mailerLiteManager->getSubscribersList($cursor, $limit);
    
            return response()->json([
                'draw' => intval($draw),
                'data' => $subscribers['data'],
                'nextCursor' => $subscribers['next_cursor'],
                'prevCursor' => $subscribers['prev_cursor'],
            ]);
        } catch (Exception $e) {
            return response()->json([
                'message' => $e->getMessage()
            ], 400);
        }
    }

    public function store(Request $request) 
    {
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
            if (Subscriber::where('email', $request->email)->exists()) {
                $notification = ['message' => 'User already exist as a subscriber', 'alert-type' => 'error'];
                return redirect()->back()->with($notification)->withInput();
            }
            
            $mailerLiteManager = new MailerLiteManager;
            $subscriber = array(
                    'email' => $request->email,
                    'fields' => array(
                        'name' => trim($request->name),
                        'country' => $request->country,
                    )
                );
            $mailerLiteManager->addSubscriber($subscriber);

            $notification = ['message' => 'Subscriber added successfully!', 'alert-type' => 'success'];
            return redirect()->route('home')->with($notification);
        } catch (Exception $e) {
            $notification = ['message' => $e->getMessage(), 'alert-type' => 'error'];
            return redirect()->back()->with($notification)->withInput();
        }
    }

    public function edit($subscriberId) 
    {
        if (!Subscriber::where('subscriber_id', $subscriberId)->exists()) {
            $notification = ['message' => 'Subscriber not found', 'alert-type' => 'error'];
            return redirect()->back()->with($notification)->withInput();
        }

        try {
            $mailerLiteManager = new MailerLiteManager;
            $subscriber = $mailerLiteManager->getSubscriber($subscriberId);
            $countries = Country::all(['name']);
    
            return view('subscribers.edit', compact('subscriber', 'countries'));
        } catch (Exception $e) {
            $notification = ['message' => $e->getMessage(), 'alert-type' => 'error'];
            return redirect()->back()->with($notification);
        }
    }

    public function update(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'country' => 'required|string',
            'subscriber_id' => 'required|exists:subscribers,subscriber_id'
        ]);

        if ($validator->fails()) {
            $notification = ['message' => $validator->errors()->first(), 'alert-type' => 'error'];
            return redirect()->back()->with($notification)->withInput();
        }

        try {
            $subscriber = Subscriber::where('subscriber_id', $request->subscriber_id)->first();
            
            $mailerLiteManager = new MailerLiteManager;
            $subscriber = array(
                    'email' => $subscriber->email,
                    'fields' => array(
                        'name' => trim($request->name),
                        'country' => $request->country,
                    )
                );
            $mailerLiteManager->updateSubscriber($subscriber);

            $notification = ['message' => 'Subscriber updated successfully!', 'alert-type' => 'success'];
            return redirect()->route('subscribers.index')->with($notification);
        } catch (Exception $e) {
            $notification = ['message' => $e->getMessage(), 'alert-type' => 'error'];
            return redirect()->back()->with($notification)->withInput();
        }
    }

    public function destroy(Request $request) 
    {
        $validator = Validator::make($request->all(), [
            'subscriber_id' => 'required|exists:subscribers,subscriber_id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ], 400);
        }

        try {
            $mailerLiteManager = new MailerLiteManager;
            $mailerLiteManager->removeSubscriber($request->subscriber_id);
            
            return response()->json([
                'success' => true,
                'message' => 'Subscriber removed successfully'
            ]);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage()
            ], 400);
        }
    }
}
