<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class System extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];

    public function role()
    {
        return $this->hasMany('App\Model\Role');
    }
    public function privilege()
    {
        return $this->hasMany('App\Model\Privilege');
    }

}
