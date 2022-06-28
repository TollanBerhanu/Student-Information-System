<?php

namespace App\Model\Syncable;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'description'
    ];


    public function college()
    {
        return $this->belongsTo('App\Model\Syncable\College');
    }

    public function department()
    {
        return $this->hasMany('App\Model\Syncable\Department');
    }
}
