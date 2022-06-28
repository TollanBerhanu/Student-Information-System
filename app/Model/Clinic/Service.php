<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class Clinic extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
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
