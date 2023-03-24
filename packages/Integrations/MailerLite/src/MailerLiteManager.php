<?php

namespace Integrations\MailerLite;

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
            throw $error;
        }
        return $api;
    }

    public static function isValidApiKey($apiKey)
    {
        try {
            $response = self::loadApi($apiKey)->validateApiKey();
            if($response['code'] == '401') {
                throw new Exception("Invalid API KEY.");
            }
            return true;
        } catch (Exception $error) {
            throw $error;
        }
    }
}
