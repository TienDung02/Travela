<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Place extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'address','country', 'tag', 'lat', 'lon', 'status'];

    public function placeMedia()
    {
        return $this->hasMany(PlaceMedia::class);
    }
}
