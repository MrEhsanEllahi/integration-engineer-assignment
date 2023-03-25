<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Integration;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Integrations\MailerLite\MailerLiteManager;

class IntegrationsController extends Controller
{
    public function index()
    {
        $integration = Integration::where('platform', Integration::PLATFORM['MAILER_LITE'])->first();
        $apiToken = $integration ? $integration->api_token : null;
        return view('integrations', compact('apiToken'));
    }

    public function validateIntegration(Request $request) {
        $validator = Validator::make($request->all(), [
            'api_token' => 'required|string'
        ]);

        if ($validator->fails()) {
            $notification = ['message' => $validator->errors()->first(), 'type' => 'error'];
            return redirect()->back()->with(['notifications' => [$notification]])->withInput();
        }

        try {
            $mailerLiteManager = new MailerLiteManager;
            $response = $mailerLiteManager->isValidApiToken($request->api_token);
            if($response) {
                Integration::create([
                    'platform' => Integration::PLATFORM['MAILER_LITE'],
                    'api_token' => $request->api_token
                ]);
            }

            $notification = ['message' => 'Account Connected successfully!', 'type' => 'success'];
            return redirect()->route('integrations.index')->with(['notifications' => [$notification]]);
        } catch (Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => 'error'];
            return redirect()->back()->with(['notifications' => [$notification]])->withInput();
        }
    }
}
