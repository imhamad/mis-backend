<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceDeliverableIcon extends Model
{
    use HasFactory;

    protected $fillable = [
        'service_id',
        'icon',
    ];

    public function service()
    {
        return $this->belongsTo(Service::class);
    }

    // hidden
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
}
