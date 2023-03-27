<?php

namespace Integrations\MailerLite;

use App\Formatters\MailerLite\SubscribersFormatter;
use App\Helpers\GeneralHelper;
use App\Models\RuntimeLog;
use App\Models\Subscriber;
use Exception;
use Illuminate\Support\Facades\Log;
use Integrations\MailerLite\Http\Api;

class MailerLiteManager
{
    /**
     * @throws Exception
     */
    public static function loadApi($apiToken = null) : Api
    {
        try {
            if (!$apiToken) {
                $apiToken = GeneralHelper::getApiToken();
            
                if (!$apiToken) {
                    throw new Exception('Store not connected');
                }
            }
            
            $api = new Api($apiToken);
            return $api;
        } catch (Exception $error) {
            Log::error("Error while creating MailerLite api instance", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['API'],
                'trace' => json_encode($error->getMessage())
            ]);
            throw $error;
        }
    }

    /**
     * @throws Exception
     */
    public static function addSubscriber($subscriber) 
    {
        $response = [];
        
        try {
            $response = self::loadApi()->addOrUpdateSubscriber($subscriber);
            
            if (!$response['success']) {
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
    
    /**
     * @throws Exception
     */
    public static function updateSubscriber($subscriber) 
    {
        $response = [];
        
        try {
            $response = self::loadApi()->addOrUpdateSubscriber($subscriber);
            if (!$response['success']) {
                throw new Exception($response['message']);
            }
            
            Log::debug("Subscriber updated successfuly", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SYNC'],
                'trace' => json_encode($response)
            ]);
            return true;
        } catch (Exception $error) {
            Log::debug("Something went wrong when updating a subscriber", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SUBSCRIBER'],
                'payload' => json_encode($response),
                'trace' => json_encode($error->getMessage())
            ]);
            throw $error;
        }
    }

    /**
     * @throws Exception
     */
    public static function getSubscribersList($cursor = null, $limit = 10) 
    {
        $response = [];
        
        try {
            $params = [
                'cursor' => $cursor,
                'limit' => $limit
            ];
            
            $response = self::loadApi()->getSubscribersList($params);
            
            if (!$response['success']) {
                throw new Exception($response['message']);
            }
            
            Log::debug("Subscribers list fetched successfully", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SUBSCRIBER'],
                'payload' => json_encode($params),
                'trace' => json_encode($response)
            ]);
            
            $formattedSubscribers = SubscribersFormatter::formatSubscribersList($response['data']);
            return $formattedSubscribers;
        } catch (Exception $error) {
            Log::debug("Something went wrong when getting subscribers list", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SUBSCRIBER'],
                'payload' => json_encode($response),
                'trace' => json_encode($error->getMessage())
            ]);
            throw $error;
        }
    }

    /**
     * @throws Exception
     */
    public static function getSubscriber($subscriberId) 
    {
        $response = [];
        
        try {      
            $response = self::loadApi()->getSubscriber($subscriberId);
            
            if (!$response['success']) {
                throw new Exception($response['message']);
            }
            
            Log::debug("Subscriber fetched successfully", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SUBSCRIBER'],
                'payload' => json_encode($subscriberId),
                'trace' => json_encode($response)
            ]);
            
            $formattedSubscriber = SubscribersFormatter::formatSubscriber($response['data']);
            return $formattedSubscriber;
        } catch (Exception $error) {
            Log::debug("Something went wrong when getting subscribers list", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SUBSCRIBER'],
                'payload' => json_encode($response),
                'trace' => json_encode($error->getMessage())
            ]);
            throw $error;
        }
    }

    /**
     * @throws Exception
     */
    public static function removeSubscriber($subscriberId)
    {
        $response = [];
        
        try {
            $response = self::loadApi()->removeSubscriber($subscriberId);
            
            if (!$response['success']) {
                throw new Exception($response['message']);
            }
            
            Subscriber::where('subscriber_id', $subscriberId)->delete();
            
            Log::debug("Subscriber removed successfully", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SUBSCRIBER'],
                'payload' => json_encode($subscriberId),
                'trace' => json_encode($response)
            ]);
            return true;
        } catch (Exception $error) {
            Log::debug("Something went wrong when removing subscriber", [
                'reference' => RuntimeLog::LOG_REFERENCES['MAILER_LITE']['SUBSCRIBER'],
                'payload' => json_encode($response),
                'trace' => json_encode($error->getMessage())
            ]);
            throw $error;
        }
    }

    /**
     * @throws Exception
     */
    public static function isValidApiToken($apiToken)
    {
        $response = [];

        try {
            $response = self::loadApi($apiToken)->validateApiToken();
            
            if (!$response['success']) {
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
