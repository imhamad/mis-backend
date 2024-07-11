<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'de_contact_fullname',
        'de_contact_business_email',
        'de_contacting_organization',
        'de_contacting_phone',
        'de_contacting_country',
        'relationship_to_deknows',
        'how_can_we_help_you',
        'de_job_title'
    ];
}
