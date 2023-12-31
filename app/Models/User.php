<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'user_code',
        'user_uuid',
        'user_type',
        'description',
        'linkedin_url',
        'first_name',
        'last_name',
        'avatar',
        'status',
        'request_status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function otp()
    {
        return $this->hasOne(OTP::class, 'user_email', 'email');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }

    public function blogs()
    {
        return $this->hasMany(Blog::class, 'user_id', 'id');
    }

    public function send_notification($notification_title, $notification_description, $type)
    {
        $this->notifications()->create([
            'notification_title' => $notification_title,
            'notification_description' => $notification_description,
            'type' => $type,
        ]);
    }

    public function unreadNotifications()
    {
        return $this->notifications()->where('status', 'unread')->get();
    }
}
