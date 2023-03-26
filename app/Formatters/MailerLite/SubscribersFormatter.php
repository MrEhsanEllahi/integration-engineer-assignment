<?php

namespace App\Formatters\MailerLite;

use Carbon\Carbon;
use stdClass;

class SubscribersFormatter
{
    public static function formatSubscribersList($data)
    {
        $formattedData['data'] = [];
        if (count($data['data']) > 0) {
            foreach ($data['data'] as $subscriber) {
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

        $formattedData['next_cursor'] = $data['meta']['next_cursor'];
        $formattedData['prev_cursor'] = $data['meta']['prev_cursor'];

        return $formattedData;
    }

    public static function formatSubscriber($data)
    {
        $unfromattedSubscriber = (object) $data['data'];
        
        $formattedSubscriber = new stdClass;
        $formattedSubscriber->id = $unfromattedSubscriber->id;
        $formattedSubscriber->name = $unfromattedSubscriber->fields['name'] ?? '';
        $formattedSubscriber->country = $unfromattedSubscriber->fields['country'] ?? '';

        return $formattedSubscriber;
    }
}
