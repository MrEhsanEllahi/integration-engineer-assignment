<?php

namespace App\Helpers;

use App\Models\Integration;
use Carbon\Carbon;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class GeneralHelper
{
    public static function getApiToken()
    {
        $integration = Integration::where('platform', Integration::PLATFORM['MAILER_LITE'])->first();
        $apiToken = $integration ? Crypt::decryptString($integration->api_token) : null;
        return $apiToken;
    }
}
