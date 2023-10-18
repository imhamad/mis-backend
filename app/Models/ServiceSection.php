<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceSection extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'breadcrumb_title',
        'breadcrumb_slug',
        'service_title',
        'service_description',
        'service_background_color',
        'service_content_direction',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function serviceDeliverableLists()
    {
        return $this->hasMany(ServiceDeliverableList::class, 'service_section_id', 'id');
    }

    public function serviceDeliverableIcons()
    {
        return $this->hasMany(ServiceDeliverableIcon::class, 'service_section_id', 'id');
    }

    public function serviceDeliverableListCommanSeparated()
    {
        return $this->serviceDeliverableLists->pluck('bullet_point')->implode(',');
    }

    public function serviceDeliverableIconsArray()
    {
        return $this->serviceDeliverableIcons->map(function ($item) {
            return url($item->icon);
        });
    }
}
