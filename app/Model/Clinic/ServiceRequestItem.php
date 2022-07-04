<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestItem extends Model
{
    protected $fillable = [
        'description', 'status', 'complete', 'service_request_id', 'service_id'
    ];

    public function service_request()
    {
        return $this->belongsTo('App\Model\Clinic\ServiceRequest');
    }
    public function service()
    {
        return $this->belongsTo('App\Model\Clinic\Service');
    }
}
