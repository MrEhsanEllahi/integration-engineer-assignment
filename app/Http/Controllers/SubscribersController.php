<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
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

    public function list(Request $request) {
        $cursor = $request->get('cursor', null);
        $limit = $request->get('limit', 10);
        $draw = $request->get('draw', 1);
        
        $mailerLiteManager = new MailerLiteManager;
        $subscribers = $mailerLiteManager->getSubscribers($cursor, $limit);

        return response()->json([
            'draw' => intval($draw),
            'data' => $subscribers['data'],
            'nextCursor' => $subscribers['next_cursor'],
            'prevCursor' => $subscribers['prev_cursor'],
        ]);
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
            if(Subscriber::where('email', $request->email)->exists()) {
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

    public function destroy(Request $request) {
        $validator = Validator::make($request->all(), [
            'subscriber_id' => 'required|exists:subscribers,subscriber_id'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first()
            ]);
        }

        try {
            $mailerLiteManager = new MailerLiteManager;
            $mailerLiteManager->removeSubscriber($request->subscriber_id);
            
            return response()->json([
                'success' => true,
                'message' => 'Subscriber removed successfully'
            ]);
        } catch (Exception $e) {
            $notification = ['message' => $e->getMessage(), 'alert-type' => 'error'];
            return redirect()->back()->with($notification)->withInput();
        }
    }
}
