<?php

namespace App\Model\Clinic;

use Illuminate\Database\Eloquent\Model;

class Symptom extends Model
{
    protected $fillable = [
        'name', 'description', 'code'
    ];
}
