<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogReview extends Model
{
    use HasFactory;

    protected $fillable = [
        'blog_id',
        'user_id',
        'review',
        'blog_status',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
}
