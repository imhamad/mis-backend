<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CaseStudyCredit extends Model
{
    use HasFactory;

    protected $fillable = [
        'case_study_id',
        'member_id',
    ];

    public function caseStudy()
    {
        return $this->belongsTo(CaseStudy::class);
    }

    public function member()
    {
        return $this->belongsTo(OurTeamMember::class);
    }

    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
