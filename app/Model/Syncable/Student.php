<?php

namespace App\Model\Syncable;
use App\Model\Syncable\Program;
use Illuminate\Database\Eloquent\Model;
use App\Model\Gate\Block_Gate;
class Student extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'middle_name',
        'last_name', 'sex',
        'status',
        'dob', 'phone_number',
        'email', 'join_year',
        'profile', 'student_id','program_id',
        'taken_semester', 'passed_semester'
    ];

    public function program()
    {
        return $this->belongsTo('App\Model\Syncable\Program');
    }
    public function gate()
    {
        return $this->belongsTo('App\Model\Gate\Block_Gate');
    
    }
  
}
