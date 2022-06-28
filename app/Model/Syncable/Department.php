<?php

namespace App\Model\Syncable;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'description'
    ];


    public function faculty()
    {
        return $this->belongsTo('App\Model\Syncable\Faculty');
    }

    public function program()
    {
        return $this->hasMany('App\Model\Syncable\Program');
    }
}
