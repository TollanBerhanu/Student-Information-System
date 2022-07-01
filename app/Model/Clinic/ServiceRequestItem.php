<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class ServiceRequestItem extends Model
{
    protected $fillable = [
        'name','description', 'status', 'service_request_id'
    ];

    public function service_request()
    {
        return $this->belongsTo('App\Model\Clinic\ServiceRequest');
    }
}
