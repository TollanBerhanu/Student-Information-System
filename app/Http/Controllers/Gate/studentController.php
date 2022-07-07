<?php

namespace App\Http\Controllers\Gate;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Syncable\Student;
use App\Model\Syncable\College;
use App\Model\Syncable\Program;
use App\Model\Syncable\Faculty;
use App\Model\Syncable\Department;
use Illuminate\Http\Request;

class studentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
            public function show($id)
            {
               
                $student = Student::find($id);
                if($student == null){
                    return redirect()->route('#')->with(['notification' => "Error",
                        'alert_type' => "warning",
                        'message' => 'Invalid Employee ID!']);
                }
                
                $program = Program::find($student->program_id);
             
                $page_title = 'Partial Student Detail';
                $page_description = 'List of Student List';
                $user = Auth::user();
                return view('pages.gate.studentDeatil',
                    compact('page_title', 'page_description', 'user', 'program', 'student'));
              
            }
      

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
