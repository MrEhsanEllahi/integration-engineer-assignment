<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\AppSetting;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Integrations\MailerLite\MailerLiteManager;

class SettingsController extends Controller
{
    public function index()
    {
        $setting = AppSetting::where('key', 'api_key')->first();
        $apiKey = $setting ? $setting->value : null;
        return view('settings', compact('apiKey'));
    }

    public function validateApiKey(Request $request) {
        $validator = Validator::make($request->all(), [
            'api_key' => 'required|string'
        ]);

        if ($validator->fails()) {
            $notification = ['message' => $validator->errors()->first(), 'type' => 'error'];
            return redirect()->back()->with(['notifications' => [$notification]])->withInput();
        }

        try {
            $mailerLiteManager = new MailerLiteManager;
            $response = $mailerLiteManager->isValidApiKey($request->api_key);
            if($response) {
                AppSetting::create([
                    'key' => 'api_key',
                    'value' => $request->api_key
                ]);
            }

            $notification = ['message' => 'Account Connected successfully!', 'type' => 'success'];
            return redirect()->route('admin.integrations.index')->with(['notifications' => [$notification]]);
        } catch (Exception $e) {
            $notification = ['message' => $e->getMessage(), 'type' => 'error'];
            return redirect()->back()->with(['notifications' => [$notification]])->withInput();
        }
    }
}
