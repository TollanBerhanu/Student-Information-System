<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class ServiceRequest extends Model
{
    protected $fillable = [
        'description', 'response', 'diagnosis_id', 'room_id', 'accepted', 'complete'
    ];

    public function service_request_items()
    {
        return $this->hasMany('App\Model\Clinic\ServiceRequestItem');
    }

    public function diagnosis()
    {
        return $this->belongsTo('App\Model\Clinic\Diagnosis');
    }

    public function room()
    {
        return $this->belongsTo('App\Model\Clinic\Room');
    }
}
