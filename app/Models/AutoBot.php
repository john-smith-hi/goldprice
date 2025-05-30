<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AutoBot extends Model
{
    /** @use HasFactory<\Database\Factories\AutoBotFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'auto_bots';

    protected $fillable = [
        'url',
        'request',
        'status_response',
        'response',
    ];
}
