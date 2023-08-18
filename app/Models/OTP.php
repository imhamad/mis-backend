<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_email',
        'otp_code',
        'otp_type'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    protected $table = 'motps';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_email', 'email');
    }
}
