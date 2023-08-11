<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServicePage extends Model
{
    use HasFactory;

    protected $table = 'service_page';

    protected $fillable = [
        'seo_title',
        'seo_meta_tags',
        'image',
        'services_heroic_block_pre_title',
        'services_heroic_block_title',
        'services_process_image',
    ];

    // hidden fields
    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];
}
