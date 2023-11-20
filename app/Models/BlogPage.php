<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPage extends Model
{
    use HasFactory;

    protected $fillable = [
        "seo_title",
        "seo_meta_tags",
        "image",
        "pre_title",
        "title",
        "description"
    ];

    // hidden fields
    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];

}
