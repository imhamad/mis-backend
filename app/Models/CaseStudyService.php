<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudyService extends Model
{
    use HasFactory;

    protected $fillable = [
        'service',
        'url',
        'case_study_id',
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
