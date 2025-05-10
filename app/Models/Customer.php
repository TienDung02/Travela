<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Customer extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'fullname', 'gender', 'birth_date'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
