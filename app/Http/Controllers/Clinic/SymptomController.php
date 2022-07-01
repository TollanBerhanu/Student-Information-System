<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Model\Clinic\Symptom;
use App\Model\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SymptomController extends Controller
{
    public function list()
    {
        $symptoms = Symptom::all();
        $page_title = 'Symptom List';
        $page_description = 'List of registered symptoms';
        $user = Auth::user();

        return view('pages.clinic.symptom.symptom_list',
            compact('page_title', 'page_description', 'user', 'symptoms'));
    }


    public function newPage()
    {
        $systems = System::all()->sortBy('name');
        $page_title = 'Register Symptom';
        $page_description = 'Register a new symptom';
        $user = Auth::user();

        return view('pages.clinic.symptom.symptom_new',
            compact('page_title', 'page_description', 'user', 'systems'));
    }

    public function newHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required'],
            'code' => ['required'],
            'description' => ['required'],
        ]);

        if (Symptom::where('name', $data['name'])->count() > 0) {
            return back()->withErrors([
                'name' => 'Name already registered.',
            ])->withInput($data);
        }

        if (Symptom::where('code', $data['code'])->count() > 0) {
            return back()->withErrors([
                'code' => 'Code already registered.',
            ])->withInput($data);
        }

        Symptom::create($data);
        return back()->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Symptom created successfully!']);
    }

    public function editPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('symptomList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $symptom = Symptom::find($id);
        if($symptom == null){
            return redirect()->route('symptomList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Symptom ID!']);
        }
        $page_title = 'Edit Symptom';
        $page_description = 'Update symptom information';
        $user = Auth::user();

        return view('pages.clinic.symptom.symptom_update',
            compact('page_title', 'page_description', 'user', 'symptom'));
    }

    public function editHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'code' => ['required'],
            'description' => ['required'],
        ]);

        $symptom = Symptom::find($data['id']);
        if (!$symptom) {
            return back()->withErrors([
                'symptom' => 'Unable to find symptom in our records.',
            ])->withInput($data);
        }
        $symptom['description'] = $data['description'];

        if ($symptom['name'] != $data['name']) {
            if (Symptom::where('name', $data['name'])->count() > 0) {
                return back()->withErrors([
                    'name' => 'Name already registered.',
                ])->withInput($data);
            }
            else{
                $symptom['name'] = $data['name'];
            }
        }
        if ($symptom['code'] != $data['code']) {
            if (Symptom::where('code', $data['code'])->count() > 0) {
                return back()->withErrors([
                    'code' => 'Code already registered.',
                ])->withInput($data);
            }
            else{
                $symptom['code'] = $data['code'];
            }
        }
        $symptom->save();
        return redirect()->route('symptomList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Symptom updated successfully!']);
    }
}
