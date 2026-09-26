<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model
{
    protected $fillable = [
        'email',
        'name',
        'phone',
        'company',
        'project_type',
        'project_scale',
        'bottleneck',
        'timeline',
        'message',
        'product_interest',
        'source',
        'type',
        'status',
        'priority',
        'notes',
        'assigned_to',
        'last_contacted_at',
    ];

    protected $casts = [
        'last_contacted_at' => 'datetime',
    ];
}
