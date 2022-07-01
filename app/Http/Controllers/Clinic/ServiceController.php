<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Model\Clinic\Diagnosis;
use App\Model\Clinic\DiagnosisDisease;
use App\Model\Clinic\DiagnosisSymptom;
use App\Model\Clinic\Disease;
use App\Model\Clinic\Room;
use App\Model\Clinic\ServiceRequest;
use App\Model\Clinic\Symptom;
use App\Model\Syncable\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function newList(Request $request)
    {
        $service_request = ServiceRequest::whereHas('room', function ($query) {
            return $query->where('user_id', '=', Auth::user()['id']);
        })->where('accepted', false)->get();
        $page_title = 'Clinic Service Request List ';
        $page_description = 'Diagnosis Service request list';
        $user = Auth::user();

        return view('pages.clinic.service.service_new_list',
            compact('page_title', 'page_description', 'user', 'service_request'));
    }

    public function acceptPage(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        if ($id == null) {
            return redirect()->route('service_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $service_request = ServiceRequest::find($id);
        if ($service_request == null) {
            return redirect()->route('service_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Diagnosis ID!']);
        }

        $service_request['accepted'] = true;
        $service_request->save();

        return redirect()->route('serviceServePage', ['id'=> $service_request['id']]);
    }

    public function servePage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('service_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $service_request = Diagnosis::find($id);
        if ($service_request == null) {
            return redirect()->route('service_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Diagnosis ID!']);
        }
        $page_title = 'Diagnosis Service';
        $page_description = 'Diagnosis service for patient';
        $user = Auth::user();

        return view('pages.clinic.service.service_serve',
            compact('page_title', 'page_description', 'user', 'service_request'));
    }

    public function completeHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'disease_list' => ['required'],
            'symptom_list' => ['required'],
            'description' => ['required'],
            'diagnosis' => ['required'],
        ]);

        $diagnosis = Diagnosis::find($data['id']);
        if ($diagnosis == null) {
            return redirect()->route('reception_StudentList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Diagnosis ID!']);
        }

        $diagnosis['description'] = $data['description'];
        $diagnosis['diagnosis'] = $data['diagnosis'];
        $disease_list = collect(\GuzzleHttp\json_decode($data['disease_list']));
        $symptom_list = collect(\GuzzleHttp\json_decode($data['symptom_list']));

        $_data_ = collect();

        DiagnosisDisease::where([['diagnosis_id', '=', $diagnosis['id']]])->delete();
        foreach($disease_list as $item){
            $disease = Disease::find($item);
            if(!$disease) continue;
            $data_ = array('diagnosis_id' => $diagnosis['id'], 'disease_id' => $item);
            $_data_->push($data_);
        }
        DiagnosisDisease::insert($_data_->toArray());


        DiagnosisSymptom::where([['diagnosis_id', '=', $diagnosis['id']]])->delete();
        $_data_ = collect();
        foreach($symptom_list as $item){
            $symptom = Symptom::find($item);
            if(!$symptom) continue;
            $data_ = array('diagnosis_id' => $diagnosis['id'], 'symptom_id' => $item);
            $_data_->push($data_);
        }
        DiagnosisSymptom::insert($_data_->toArray());

        $diagnosis['complete'] = true;
        $diagnosis->save();
        return redirect()->route('diagnosis_NewList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Patient information submitted successfully!']);
    }
}
