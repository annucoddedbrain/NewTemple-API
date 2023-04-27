<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TemplePost extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'location',
        'location_LatLng',
        'time_table',
        'user_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function meta(){
        return $this->hasMany(Meta::class);
    }

    // hmm bolo ky likha h isme
}
