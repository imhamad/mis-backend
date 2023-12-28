<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'seo_title',
        'seo_meta_tags',
        'image',
        'service_pre_title',
        'service_title',
        'slug',
        'service_description',
        'service_icon',
        'client_name',
        'client_designation',
        'client_review',
        'client_image',
        'keywords',
        'og_url',
        'process_image',
        'video',
        'menu_visibility',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    // make slug from title while creating
    public static function boot()
    {
        parent::boot();
        static::creating(function ($service) {
            $service->slug = Str::slug($service->service_pre_title);
        });
    }
}
