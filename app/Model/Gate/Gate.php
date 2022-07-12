<?php

namespace App\Model\Gate;

use App\Model\Syncable\College;
use Illuminate\Database\Eloquent\Model;

class Gate extends Model
{

protected $table = 'gate';
protected $fillable = [
    'gate_name',
    'college_id'
];
public function college()
{
    return $this->belongsTo('App\Model\Syncable\College');
}
}
