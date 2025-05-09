<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Package extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'price', 'duration', 'tour_id'];

    public function tour()
    {
        return $this->belongsTo(Tour::class);
    }
}
