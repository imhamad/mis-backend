<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;

    protected $table = 'home_page';

    protected $fillable = [
        'seo_title',
        'seo_meta_tags',
        'image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];
}
