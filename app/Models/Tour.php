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

    protected $fillable = ['name', 'desc', 'location', 'start_date', 'end_date', 'price'];
    protected $casts = [
        'types' => 'array',
        'start_date' => 'date',
    ];
    public function packages()
    {
        return $this->hasMany(Package::class);
    }
    public function reviews()
    {
        return $this->morphMany(Review::class, 'reviewable');
    }
}
