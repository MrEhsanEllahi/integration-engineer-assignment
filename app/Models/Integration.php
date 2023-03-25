<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Integration extends Model
{
    protected $table = 'integrations';

    const PLATFORM = [
        'MAILER_LITE' => 0
    ];
    
    protected $fillable = [
        'platform',
        'api_token'
    ];
}
