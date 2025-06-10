<?php


namespace App\Models;
// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class Tour extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'desc', 'price'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',

    ];

    public function packages()
    {
        return $this->hasMany(Package::class);
    }
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
    public function place()
    {
        return $this->hasOneThrough(
            \App\Models\Place::class,
            \App\Models\TourPlace::class,
            'tour_id',     // tour_places.tour_id
            'id',          // places.id
            'id',          // tours.id
            'place_id'     // tour_places.place_id
        );
    }
}
