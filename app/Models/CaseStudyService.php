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
    ];

    public function caseStudy()
    {
        return $this->belongsTo(CaseStudy::class);
    }
}
