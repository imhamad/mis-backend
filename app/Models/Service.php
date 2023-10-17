<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'seo_title',
        'seo_meta_tags',
        'image',
        'service_pre_title',
        'service_title',
        'service_description',
        'service_icon',
        'client_name',
        'client_designation',
        'client_review',
        'client_image',
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
