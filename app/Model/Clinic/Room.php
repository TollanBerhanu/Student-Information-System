<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    protected $fillable = [
        'name', 'description', 'clinic_id', 'user_id', 'room_type_id',
    ];

    public function room_type()
    {
        return $this->belongsTo('App\Model\Clinic\RoomType');
    }
    public function clinic()
    {
        return $this->belongsTo('App\Model\Clinic\Clinic');
    }
    public function user()
    {
        return $this->belongsTo('App\Model\User');
    }

    public function services()
    {
        return $this->hasMany('App\Model\Clinic\Service');
    }
}
