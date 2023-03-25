<?php

namespace App\Formatters\MailerLite;

use Carbon\Carbon;
use stdClass;

class SubscribersFormatter
{
    public static function formatForDataTable($response)
    {
        $formattedData['data'] = [];
        if(count($response['data']) > 0) {
            foreach($response['data'] as $subscriber) {
                $subscriber = (object) $subscriber;
                
                $formattedSubscriber = new stdClass;
                $formattedSubscriber->id = $subscriber->id;
                $formattedSubscriber->name = $subscriber->fields['name'] ?? '';
                $formattedSubscriber->email = $subscriber->email;
                $formattedSubscriber->country = $subscriber->fields['country'] ?? '';
                $formattedSubscriber->subscribed_date = Carbon::parse($subscriber->subscribed_at)->format('d/m/Y');
                $formattedSubscriber->subscribed_time = Carbon::parse($subscriber->subscribed_at)->format('H:i:s');
                
                array_push($formattedData['data'], $formattedSubscriber);
            }
        }

        $formattedData['next_cursor'] = $response['meta']['next_cursor'];
        $formattedData['prev_cursor'] = $response['meta']['prev_cursor'];

        return $formattedData;
    }
}
