<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meta extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'filenames',
        'path',
        'size',
        'type',
        'temple_post_id',
        'user_id',
    ];

    public function setFilenamesAttributes($value){
        $this->attributes['filenames'] = json_encode($value);
    }

    public function posts(){
        return $this->belongsTo(TemplePost::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
