<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudySlider extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_study_id',
        'title',
        'descriptive_title',
        'image',
        'cta',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function caseStudy()
    {
        return $this->belongsTo(CaseStudy::class);
    }
}
