<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'description',
        'name',
        'designation',
        'company',
        'image',
        'video',
        'type',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
