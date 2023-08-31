<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CaseStudy extends Model
{
    use HasFactory;

    protected $fillable = [
        'seo_title',
        'seo_meta_tags',
        'image',
        'title',
        'slug',
        'button_title',
        'cta',
        'case_study_image',
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

    protected $hidden = [
        'created_at',
        'updated_at',
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

    // set slug attribute by making the title attribute
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = Str::slug($this->attributes['title']);
    }

    public function caseStudySliders()
    {
        return $this->hasMany(CaseStudySlider::class);
    }

    public function caseStudyMembers()
    {
        return $this->hasMany(CaseStudyMember::class);
    }

    public function caseStudyCredits()
    {
        return $this->hasMany(CaseStudyCredit::class);
    }
}
