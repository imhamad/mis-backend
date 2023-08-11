<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'breadcrumb_title',
        'service_title',
        'service_first_paragraph',
        'service_second_paragraph',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function serviceDeliverableLists()
    {
        return $this->hasMany(ServiceDeliverableList::class);
    }

    public function serviceDeliverableIcons()
    {
        return $this->hasMany(ServiceDeliverableIcon::class);
    }
}
