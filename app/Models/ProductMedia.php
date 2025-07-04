<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
class ProductMedia extends Model
{
    use HasFactory;

    protected $fillable = ['product_id', 'media', 'media_type', 'is_primary'];

    public function place()
    {
        return $this->belongsTo(Place::class);
    }
}
