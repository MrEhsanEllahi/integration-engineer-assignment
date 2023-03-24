<?php

namespace Integrations\MailerLite;

use App\Models\RuntimeLog;
use Exception;
use Illuminate\Support\Facades\Log;
use Integrations\MailerLite\Http\Api;

class MailerLiteManager
{

    public static function loadApi($apiKey)
    {
        try {
            $api = new Api($apiKey);
        } catch (Exception $error) {
            Log::error("Error while creating MailerLite api instance for API-KEY: {$apiKey}", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['API'],
                'trace' => json_encode($error->getMessage())
            ]);
        }
        return $api;
    }

    public static function isValidApiKey($apiKey)
    {
        try {
            $response = self::loadApi($apiKey)->validateApiKey();
            if($response['success'] == false) {
                throw new Exception($response['message']);
            }
            Log::debug("MailerLite API KEY is validated successfully: {$apiKey}", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SYNC'],
                'trace' => json_encode($response)
            ]);
        } catch (Exception $error) {
            Log::debug("Something went wrong when validating API-KEY: {$apiKey}", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SYNC'],
                'payload' => json_encode($response),
                'trace' => json_encode($error->getMessage())
            ]);
            throw $error;
        }
    }
}
