<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class RolePrivilege extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'status'
    ];

    public function role()
    {
        return $this->belongsTo('App\Model\Role');
    }
    public function privilege()
    {
        return $this->belongsTo('App\Model\Privilege');
    }

}
