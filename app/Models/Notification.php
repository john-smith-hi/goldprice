<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    /** @use HasFactory<\Database\Factories\NotificationFactory> */
    use HasFactory, SoftDeletes;

    protected $table = 'notifications';

    protected $fillable = [
        'text',
        'read',
    ];

    protected $casts = [
        'read' => 'integer',
        'deleted_at' => 'datetime',
    ];
}
