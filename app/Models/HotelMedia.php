<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class HotelMedia extends Model
{
    use HasFactory;

    protected $fillable = ['hotel_id', 'media', 'media_type', 'is_primary'];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
