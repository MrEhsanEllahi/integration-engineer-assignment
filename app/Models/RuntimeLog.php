<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class RuntimeLog extends Model
{
    public const LOG_REFERENCES = [
        'MAILER_LITE' => [
            'API' => 'mailerLite::api-instance',
            'SYNC' => 'mailerLite::sync-key'
        ]
    ];

    public const LOG_LEVELS = ['DEBUG', 'ERROR', 'INFO', 'ALERT', 'WARNING'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference',
        'title',
        'level',
        'trace',
        'payload'
    ];
}
