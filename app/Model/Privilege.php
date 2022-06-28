<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Privilege extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    public function rolePrivilege()
    {
        return $this->hasMany('App\Model\RolePrivilege');
    }

    public function system()
    {
        return $this->belongsTo('App\Model\System');
    }

}
