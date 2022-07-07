<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use App\Model\Clinic\Clinic;
use App\Model\Clinic\Diagnosis;
use App\Model\Clinic\Room;
use App\Model\Syncable\College;
use App\Model\Syncable\Student;
use App\Model\Gate\Pc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class pcController extends Controller
{
    public function search(Request $request)
    {
        $query = $request->query('query');
        if ($query != null) {
            $students = Student::whereHas('program', function ($query) {
                return $query->whereHas('department', function ($query) {
                    return $query->whereHas('faculty', function ($query) {
                        return $query->whereHas('college', function ($query) {
                            return $query->where('id', '=', Auth::user()['college_id']);
                        });
                    });
                });
            })->where('first_name', "like", "%" . $query . "%")->
            orWhere('last_name', "like", "%" . $query . "%")->
            orWhere('student_id', "like", "%" . $query . "%")->get();
        } else {
            $students = Student::whereHas('program', function ($query) {
                return $query->whereHas('department', function ($query) {
                    return $query->whereHas('faculty', function ($query) {
                        return $query->whereHas('college', function ($query) {
                            return $query->where('id', '=', Auth::user()['college_id']);
                        });
                    });
                });
            })->get();
        }
        $page_title = 'Clinic Student List ';
        $page_description = 'Student list';
        $user = Auth::user();

        return view('pages.gate.PC.studentList',
            compact('page_title', 'page_description', 'user', 'students'));
    }

    public function acceptPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('reception_StudentList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $student = Student::find($id);
        if ($student == null) {
            return redirect()->route('reception_StudentList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Student ID!']);
        }
        $rooms = Room::whereHas('room_type', function ($query) {
            return $query->where('name', '=', "Diagnosis");
        })->whereHas('clinic', function ($query) {
            return $query->whereHas('college', function ($query) {
                return $query->where('id', '=', Auth::user()['college_id']);
            });
        })->get();
        $page_title = 'Patient Acceptance';
        $page_description = 'Accept students for diagnosis';
        $user = Auth::user();
        return view('pages.gate.PC.pcRegister',
            compact('page_title', 'page_description', 'user', 'student'));
    }

    public function acceptHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'room_id' => ['required'],
        ]);

        $student = Student::find($data['id']);
        if ($student == null) {
            return redirect()->route('reception_StudentList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Clinic ID!']);
        }

        $room = Room::find($data['room_id']);
        if (!$room) {
            return back()->withErrors([
                'room_id' => 'Room cannot be None.',
            ])->withInput($data);
        }
        $_data = ['student_id' => $data['id'], 'room_id' => $data['room_id']];
        Diagnosis::create($_data);
        return redirect()->route('reception_StudentList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Student information submitted successfully!']);
    }
    public function editPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('clinicList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $clinic = Clinic::find($id);
        if ($clinic == null) {
            return redirect()->route('clinicList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Clinic ID!']);
        }
        $colleges = College::all()->sortBy('name');
        $page_title = 'Edit Clinic';
        $page_description = 'Update clinic information';
        $user = Auth::user();


        return view('pages.clinic.reception.clinic_update',
            compact('page_title', 'page_description', 'user', 'clinic', 'colleges'));
    }

    public function editHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
//            'college_id' => ['required'],
        ]);

        $clinic = Clinic::find($data['id']);
        if (!$clinic) {
            return back()->withErrors([
                'clinic' => 'Unable to find clinic in our records.',
            ])->withInput($data);
        }
        $clinic['description'] = $data['description'];

//        if($data['college_id'] == -1){
//            return back()->withErrors([
//                'college_id' => 'College cannot be None.',
//            ])->withInput($data);
//        }
//        else if($clinic['college_id'] != $data['college_id']){
//            $college = College::find($data['college_id']);
//            if (!$college) {
//                return back()->withErrors([
//                    'college_id' => 'Invalid College ID',
//                ])->withInput($data);
//            }
//            else{
//                $clinic['college_id'] = $college->id;
//            }
//        }

        if ($clinic['name'] != $data['name']) {
            if (Clinic::where('name', $data['name'])->count() > 0) {
                return back()->withErrors([
                    'name' => 'Name already registered.',
                ])->withInput($data);
            } else {
                $clinic['name'] = $data['name'];
            }
        }
        $clinic->save();
        return redirect()->route('clinicList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Clinic updated successfully!']);
    }



    /////////////////////////////////////////////////////////////////
    /// /////////////////////////////////////////////////////
    ///
    ///
    ///
    ///
    ///
    public function store(Request $request)
    {

        //////////////////////////////////////////
        //First validate here and then save it to the database

        $validatedData = $request->validate([
            't_mark'=>["required"],
            'serialNo'=>'required|unique:pc',
            'color'=>["required"]
        ]);




        $ID=$request->id;
        $t_mark=$request->t_mark;
        $serialNo=$request->serialNo;
        $color=$request->color;
      //  dd($serialNo);
        DB::table('pc')->insert([
            'student_id' => $ID,
            't_mark' => $t_mark,
            'serialNo'=>$serialNo,
            'color'=>$color
        ]);

        $request->session()->flash('success', 'Successfully Saved');

        return redirect(route('pc.studentList'))->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'PC registered successfully!']);
        //  return redirect()->route('pc.index');e

        //
    }





    public function studentPcList(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('reception_StudentList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $studentPc = Pc::where('student_id',$id)->get();
//        dd($studentPc);

        if (count($studentPc)== 0) {
            return redirect()->route('registerPc',$id)->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'You have not registered Pc, yet!']);
        }

        $page_title = 'Pc Table';
        $page_description = 'Student and list of pc';
        $user = Auth::user();
        return view('pages.gate.PC.studentPcList',
            compact('page_title', 'page_description', 'user', 'studentPc'));
    }


}
