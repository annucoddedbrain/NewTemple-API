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

    public function comment(){
        return $this->hasMany(TempleComment::class)->whereNull('parent_id');
    }

    // hmm bolo ky likha h isme
}
