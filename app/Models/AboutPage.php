<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutPage extends Model
{
    use HasFactory;

    protected $table = 'about_page';

    protected $fillable = [
        'seo_title',
        'seo_meta_tags',
        'image',
        'about_heroic_block_pre_title',
        'about_heroic_block_title',
        'about_cta_link',
        'about_open_source_culture',
        'keywords',
        'og_url',
    ];

    // hidden fields
    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];
}
