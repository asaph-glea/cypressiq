<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $fillable = ['name', 'email', 'phone', 'preferred_time_slot', 'status', 'assigned_to'];

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
