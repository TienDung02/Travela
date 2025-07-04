<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['province_id', 'name'];

    public function province()
    {
        return $this->belongsTo(Province::class, 'province_id', 'id');
    }

}
