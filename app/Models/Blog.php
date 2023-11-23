<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'category_id',
        'user_id',
        'slug',
        'status',
        'summary',
    ];

    protected $hidden = [
        // 'created_at',
        // 'updated_at',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function scopeCurrentuser($query, $status = null)
    {
        if ($status == null) {
            return $query->where('user_id', auth()->user()->id);
        }
        return $query->where('status', $status)->where('user_id', auth()->user()->id);
    }

    public function reviews()
    {
        return $this->hasMany(BlogReview::class);
    }

    public function fetchLastReview()
    {
        return $this->reviews()->orderBy('id', 'desc')->first()->review ?? null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public static function onSlug($slug)
    {
        return self::where('slug', $slug);
    }
}
