<?php

namespace App\Model\Gate;

use Illuminate\Database\Eloquent\Model;
use App\Model\Syncable\Student;


class Block_Gate extends Model
{
  
    protected $table = 'block_gate';
    protected $fillable = [
        'alert',
        'student_id'
    ];

    public function student()
    {
        return $this->hasMany(Student::class,'student_id');
    }
}
