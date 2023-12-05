<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomePage extends Model
{
    use HasFactory;

    protected $table = 'home_page';

    protected $fillable = [
        'seo_title',
        'seo_meta_tags',
        'image',
        'countries',
        'keywords',
        'og_url',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'id'
    ];


    // countries are stored as comma separated values in database, so we need to convert it into array
    public function getCountriesList()
    {
        return explode(',', $this->countries);
    }
}
