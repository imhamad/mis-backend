<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'button_title',
        'cta',
        'image',
        'tags',
        'about_the_client',
        'industry_of_client',
        'industry_of_client_image',
        'challenge',
        'value',
        'project_credit',
        'client_name',
        'client_designation',
        'client_review',
        'client_image',
    ];

    protected $casts = [
        'tags' => 'array',
    ];

    public function getTagsAttribute($value)
    {
        return json_decode($value);
    }

    public function setTagsAttribute($value)
    {
        $this->attributes['tags'] = json_encode($value);
    }

    public function caseStudyServices()
    {
        return $this->hasMany(CaseStudyService::class);
    }
}
