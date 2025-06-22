<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Post;
class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;


    protected $fillable = [
        'fullname',
        'email',
        'gender',
        'phone',
        'password',
        'provider',
        'provider_id',
        'remember_token',
        'phone',
        'role_id',
        'ward_id'
    ];

    public function posts()
    {
        return $this->hasMany(\App\Models\Post::class);
    }
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

//    public function places()
//    {
//        return $this->hasMany(Place::class);
//    }

    public function blogs()
    {
        return $this->hasMany(Blog::class);
    }
    public function ward()
    {
        return $this->belongsTo(Ward::class, 'ward_id');
    }
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
}
