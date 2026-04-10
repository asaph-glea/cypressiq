<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = ['company_email', 'phone_number', 'whatsapp_number', 'address', 'google_map_embed'];
}
