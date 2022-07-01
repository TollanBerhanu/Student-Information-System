<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class Disease extends Model
{
    protected $fillable = [
        'name', 'description', 'code'
    ];
}
