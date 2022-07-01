<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class DiagnosisSymptom extends Model
{
    protected $fillable = [
        'diagnosis_id', 'symptom_id'
    ];

    public function diagnosis()
    {
        return $this->belongsTo('App\Model\Clinic\Diagnosis');
    }
    public function symptom()
    {
        return $this->belongsTo('App\Model\Clinic\Symptom');
    }
}
