<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class Diagnosis extends Model
{
    protected $fillable = [
        'description', 'diagnosis', 'accepted', 'pending_request', 'complete', 'discarded', 'student_id', 'room_id',
    ];

    public function room()
    {
        return $this->belongsTo('App\Model\Clinic\Room');
    }
    public function student()
    {
        return $this->belongsTo('App\Model\Syncable\Student');
    }
    public function diagnosis_user()
    {
        return $this->hasOne('App\Model\Clinic\UserDiagnosis');
    }

    public function diseases()
    {
        return $this->hasMany('App\Model\Clinic\DiagnosisDisease');
    }

    public function symptoms()
    {
        return $this->hasMany('App\Model\Clinic\DiagnosisSymptom');
    }

    public function services()
    {
        return $this->hasMany('App\Model\Clinic\ServiceRequest');
    }
}
