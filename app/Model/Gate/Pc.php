<?php

namespace App\Model\Gate;

use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
protected $table = 'pc';
protected $fillable = [
    'student_id',
    't_mark',
    'serialNo',
    'color'

];

public function student()
{
    return $this->belongsTo('App\Model\Syncable\Student');
}
}
