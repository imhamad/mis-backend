<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudyPage extends Model
{
    use HasFactory;

    protected $table = 'case_study_page';

    protected $fillable = [
        'seo_title',
        'seo_meta_tags',
        'image',
        'casestudy_heroic_block_pre_title',
        'casestudy_heroic_block_title',
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
