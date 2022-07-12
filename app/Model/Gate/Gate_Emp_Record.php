<?php

namespace App\Model\Gate;
use Illuminate\Database\Eloquent\Model;


class Gate_Emp_Record extends Model
{
protected $table = 'gate_emp_record';
protected $fillable = [
    'gate_id',
    'user_id',
    'shift'
];

public function user()
{
    return $this->belongsTo('App\Model\User','user_id');
}
public function gate()
{
    return $this->belongsTo('App\Model\Gate\Gate','gate_id');
}
}
