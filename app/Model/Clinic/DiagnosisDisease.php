<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class DiagnosisDisease extends Model
{
    protected $fillable = [
        'diagnosis_id', 'disease_id'
    ];

    public function diagnosis()
    {
        return $this->belongsTo('App\Model\Clinic\Diagnosis');
    }
    public function disease()
    {
        return $this->belongsTo('App\Model\Clinic\Disease');
    }
}
