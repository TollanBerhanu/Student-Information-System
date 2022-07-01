<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{
    protected $fillable = [
        'name', 'description', 'college_id', 'active'
    ];

    public function college()
    {
        return $this->belongsTo('App\Model\Syncable\College');
    }
    public function room()
    {
        return $this->hasMany('App\Model\Clinic\Room');
    }
}
