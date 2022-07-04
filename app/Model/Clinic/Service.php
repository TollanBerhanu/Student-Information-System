<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    protected $fillable = [
        'name', 'description', 'room_id'
    ];

    public function room()
    {
        return $this->belongsTo('App\Model\Clinic\Room');
    }
    public function clinic()
    {
        return $this->belongsTo('App\Model\Clinic\Clinic');
    }
}
