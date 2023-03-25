<?php

namespace Integrations\MailerLite;

use App\Models\RuntimeLog;
use App\Models\Subscriber;
use Exception;
use Illuminate\Support\Facades\Log;
use Integrations\MailerLite\Http\Api;

class MailerLiteManager
{
    public static function loadApi($apiToken)
    {
        try {
            $api = new Api($apiToken);
        } catch (Exception $error) {
            Log::error("Error while creating MailerLite api instance", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['API'],
                'trace' => json_encode($error->getMessage())
            ]);
        }
        return $api;
    }

    public static function addSubscriber($apiToken, $subscriber) {
        try {
            $response = self::loadApi($apiToken)->addSubscriber($subscriber);
            if($response['success'] == false) {
                throw new Exception($response['message']);
            }
            Subscriber::create([
                'subscriber_id' => $response['data']['data']['id'],
                'email' => $subscriber['email'],
            ]);
            Log::debug("Subscriber added successfuly", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SYNC'],
                'trace' => json_encode($response)
            ]);
            return true;
        } catch (Exception $error) {
            Log::debug("Something went wrong when adding a subscriber", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SUBSCRIBER'],
                'payload' => json_encode($response),
                'trace' => json_encode($error->getMessage())
            ]);
            throw $error;
        }
    }

    public static function isValidApiToken($apiToken)
    {
        try {
            $response = self::loadApi($apiToken)->validateApiToken();
            if($response['success'] == false) {
                throw new Exception($response['message']);
            }
            Log::debug("MailerLite API-TOKEN is validated successfully", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SYNC'],
                'trace' => json_encode($response)
            ]);
            return true;
        } catch (Exception $error) {
            Log::debug("Something went wrong when validating API-TOKEN", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SYNC'],
                'payload' => json_encode($response),
                'trace' => json_encode($error->getMessage())
            ]);
            throw $error;
        }
    }
}
