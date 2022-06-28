<?php

namespace App\Model\Syncable;

use Illuminate\Database\Eloquent\Model;

class College extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'description'
    ];

    public function user()
    {
        return $this->hasMany('App\Model\User');
    }

    public function faculty()
    {
        return $this->hasMany('App\Model\Syncable\Faculty');
    }
}
