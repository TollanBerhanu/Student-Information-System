<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Model\Clinic\Clinic;
use App\Model\Syncable\College;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClinicController extends Controller
{
    public function list()
    {

        $clinics = Clinic::all();
        $page_title = 'Clinic List';
        $page_description = 'List of registered clinics';
        $user = Auth::user();

        return view('pages.clinic.clinic.clinic_list',
            compact('page_title', 'page_description', 'user', 'clinics'));
    }


    public function newPage()
    {
        $colleges = College::all()->sortBy('name');
        $page_title = 'Register Clinic';
        $page_description = 'Register a new clinic';
        $user = Auth::user();

        return view('pages.clinic.clinic.clinic_new',
            compact('page_title', 'page_description', 'user', 'colleges'));
    }

    public function newHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'college_id' => ['required'],
        ]);

        if (Clinic::where('name', $data['name'])->count() > 0) {
            return back()->withErrors([
                'name' => 'Name already registered.',
            ])->withInput($data);
        }

        $college = College::find($data['college_id']);
        if (!$college) {
            return back()->withErrors([
                'college_id' => 'College cannot be None.',
            ])->withInput($data);
        }
        $data['active'] = true;
        Clinic::create($data);
        return back()->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Clinic created successfully!']);
    }

    public function editPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('clinicList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $clinic = Clinic::find($id);
        if($clinic == null){
            return redirect()->route('clinicList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Clinic ID!']);
        }
        $colleges = College::all()->sortBy('name');
        $page_title = 'Edit Clinic';
        $page_description = 'Update clinic information';
        $user = Auth::user();


        return view('pages.clinic.clinic.clinic_update',
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
            }
            else{
                $clinic['name'] = $data['name'];
            }
        }
        $clinic->save();
        return redirect()->route('clinicList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Clinic updated successfully!']);
    }
}
