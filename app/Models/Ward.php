<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ward extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = ['district_id', 'name'];

    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id');
    }

}
