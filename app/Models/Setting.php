<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        'terms_of_use',
        'privacy_policy',
        'app_name',
        'app_logo',
        'app_icon',
        'app_email',
        'app_phone',
        'app_address',
        'about_us',
        'facebook',
        'twitter',
        'instagram',
    ];
}
