<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
class Tour extends Model
{
     /** @use HasFactory<\Database\Factories\UserFactory> */
     use  HasFactory, Notifiable, SoftDeletes;
    //
    protected $primaryKey = 'id';

    protected $fillable = [
  

        'name',
        'desc',
        'location',
        'start_date',
        'end_date',
        'price',
        'created_at',
        'updated_at',
       
    ];






    protected $dates = ['deleted_at'];
    public $timestamps = true;
}
