<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OpenSourceCulture extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'icon',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'status'
    ];
}
