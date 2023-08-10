<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SEOTag extends Model
{
    use HasFactory;

    protected $table = 'seo_tags';

    protected $fillable = [
        'page_name',
        'seo_title',
        'seo_description',
        'icon',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'status'
    ];
}
