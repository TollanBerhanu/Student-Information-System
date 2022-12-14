<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Model\Clinic\Disease;
use App\Model\System;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiseaseController extends Controller
{
    public function list()
    {

        $diseases = Disease::all();
        $page_title = 'Disease List';
        $page_description = 'List of registered diseases';
        $user = Auth::user();

        return view('pages.clinic.disease.disease_list',
            compact('page_title', 'page_description', 'user', 'diseases'));
    }


    public function newPage()
    {
        $systems = System::all()->sortBy('name');
        $page_title = 'Register Disease';
        $page_description = 'Register a new disease';
        $user = Auth::user();

        return view('pages.clinic.disease.disease_new',
            compact('page_title', 'page_description', 'user', 'systems'));
    }

    public function newHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required'],
            'code' => ['required'],
            'description' => ['required'],
        ]);

        if (Disease::where('name', $data['name'])->count() > 0) {
            return back()->withErrors([
                'name' => 'Name already registered.',
            ])->withInput($data);
        }

        if (Disease::where('code', $data['code'])->count() > 0) {
            return back()->withErrors([
                'code' => 'Code already registered.',
            ])->withInput($data);
        }

        Disease::create($data);
        return back()->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Disease created successfully!']);
    }

    public function editPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('diseaseList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $disease = Disease::find($id);
        if($disease == null){
            return redirect()->route('diseaseList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Disease ID!']);
        }
        $page_title = 'Edit Disease';
        $page_description = 'Update disease information';
        $user = Auth::user();

        return view('pages.clinic.disease.disease_update',
            compact('page_title', 'page_description', 'user', 'disease'));
    }

    public function editHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'code' => ['required'],
            'description' => ['required'],
        ]);

        $disease = Disease::find($data['id']);
        if (!$disease) {
            return back()->withErrors([
                'disease' => 'Unable to find disease in our records.',
            ])->withInput($data);
        }
        $disease['description'] = $data['description'];

        if ($disease['name'] != $data['name']) {
            if (Disease::where('name', $data['name'])->count() > 0) {
                return back()->withErrors([
                    'name' => 'Name already registered.',
                ])->withInput($data);
            }
            else{
                $disease['name'] = $data['name'];
            }
        }

        if ($disease['code'] != $data['code']) {
            if (Disease::where('code', $data['code'])->count() > 0) {
                return back()->withErrors([
                    'code' => 'Code already registered.',
                ])->withInput($data);
            }
            else{
                $disease['code'] = $data['code'];
            }
        }
        $disease->save();
        return redirect()->route('diseaseList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Disease updated successfully!']);
    }
}
