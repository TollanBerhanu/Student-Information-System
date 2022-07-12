<?php

namespace App\Http\Controllers\Gate\gateList;
use App\Http\Controllers\Controller;
use App\Model\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Gate\Gate;
use App\Model\Gate\Pc;
use App\Model\Gate\Gate_Emp_Record;
use App\Model\Syncable\Student;
use App\Model\Gate\Block_Gate;
use App\Model\Role;
use App\Model\Syncable\Program;
use App\Model\Syncable\Faculty;
use App\Model\System;
use App\Model\Syncable\College;
use App\Model\Syncable\Department;

class gateListController extends Controller
{
public function gateList()
{
    $gateList = Gate::all()->get();
    $_user =Auth::user();
    $page_title ="Gate List";
    return view('pages.gate.gateList',compact('_user','gateList'));
}

}