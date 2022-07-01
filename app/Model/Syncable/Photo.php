<?php

namespace App\Model\Syncable;

use App\Model\Syncable\Student;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $fillable = [
        'photo_id', 'photo'
    ];

    public function student()
    {
        return $this->belongsTo('App\Model\Syncable\Student');
    }
}
