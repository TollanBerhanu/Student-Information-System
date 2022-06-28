<?php

namespace App\Model\Syncable;

use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'code', 'description'
    ];

    public function department()
    {
        return $this->belongsTo('App\Model\Syncable\Department');
    }

    public function student()
    {
        return $this->hasMany('App\Model\Syncable\Student');
    }
}
