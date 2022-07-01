<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pc_History extends Model
{
  
protected $table = 'pc_history';
protected $fillable = [
    'student_id',
];

public function student()
{
    return $this->belongsTo('App\Model\Syncable\Student');
}
}
