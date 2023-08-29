<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BackgroundColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'color_name',
        'color_code',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
