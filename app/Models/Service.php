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
        'description',
        'background_color',
        'direction',
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
