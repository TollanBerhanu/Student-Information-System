<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'system_id'
    ];

    public function role_privilege()
    {
        return $this->hasMany('App\Model\RolePrivilege');
    }

    public function system()
    {
        return $this->belongsTo('App\Model\System');
    }

    public function user()
    {
        return $this->hasMany('App\Model\User');
    }
}
