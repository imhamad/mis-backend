<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OurTeamMember extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'designation',
        'image',
        'url',
        'is_current',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
