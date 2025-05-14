<?php


namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class TourPlace extends Model
{
    use HasFactory;
    protected $fillable = ['tour_id', 'place_id', 'day_number', 'duration_days', 'note'];
    public function place()
    {
        return $this->belongsTo(Tour::class);
    }
    public function packages()
    {
        return $this->hasMany(Place::class);
    }

}
