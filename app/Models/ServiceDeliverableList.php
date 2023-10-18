<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDeliverableList extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_section_id',
        'bullet_point',
    ];

    public function serviceSection()
    {
        return $this->belongsTo(ServiceSection::class, 'service_section_id', 'id');
    }

    // hidden
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
