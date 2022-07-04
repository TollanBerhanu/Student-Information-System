<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Model\Clinic\Diagnosis;
use App\Model\Clinic\DiagnosisDisease;
use App\Model\Clinic\DiagnosisSymptom;
use App\Model\Clinic\Disease;
use App\Model\Clinic\Room;
use App\Model\Clinic\Service;
use App\Model\Clinic\ServiceRequest;
use App\Model\Clinic\ServiceRequestItem;
use App\Model\Clinic\Symptom;
use App\Model\Syncable\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiagnosisController extends Controller
{
    public function newList(Request $request)
    {
        $diagnoses = Diagnosis::whereHas('room', function ($query) {
            return $query->where('user_id', '=', Auth::user()['id']);
        })->where('accepted', false)->orWhere([['accepted','=',true], ['pending_request','=',false]])->get();
        $page_title = 'Clinic Diagnosis Request List ';
        $page_description = 'Student Diagnosis request list';
        $user = Auth::user();

        return view('pages.clinic.diagnosis.diagnosis_new_list',
            compact('page_title', 'page_description', 'user', 'diagnoses'));
    }
    public function pendingList(Request $request)
    {
        $diagnoses = Diagnosis::whereHas('room', function ($query) {
            return $query->where('user_id', '=', Auth::user()['id']);
        })->where('accepted', true)->where('pending_request', true)->get();
        $page_title = 'Clinic Diagnosis Request List ';
        $page_description = 'Student Diagnosis request list';
        $user = Auth::user();

        return view('pages.clinic.diagnosis.diagnosis_pending_list',
            compact('page_title', 'page_description', 'user', 'diagnoses'));
    }

    public function acceptPage(Request $request, $id): \Illuminate\Http\RedirectResponse
    {
        if ($id == null) {
            return redirect()->route('diagnosis_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $diagnosis = Diagnosis::find($id);
        if ($diagnosis == null) {
            return redirect()->route('diagnosis_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Diagnosis ID!']);
        }

        $diagnosis['accepted'] = true;
        $diagnosis->save();

        return redirect()->route('diagnosisDiagnosePage', ['id'=> $diagnosis['id']]);
    }

    public function diagnosePage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('diagnosis_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $diagnosis = Diagnosis::find($id);
        if ($diagnosis == null) {
            return redirect()->route('diagnosis_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Diagnosis ID!']);
        }

        $symptoms = Symptom::all()->sortBy('name');
        $diseases = Disease::all()->sortBy('name');
        $diagnosis_symptoms = [];
        foreach(DiagnosisSymptom::where([['diagnosis_id', '=', $diagnosis['id']]])->get() as $ds){
            $diagnosis_symptoms[] = $ds['symptom']['id'];
        }
        $diagnosis_symptoms = json_encode($diagnosis_symptoms);
        $diagnosis_diseases = [];
        foreach(DiagnosisDisease::where([['diagnosis_id', '=', $diagnosis['id']]])->get() as $dd){
            $diagnosis_diseases[] = $dd['disease']['id'];
        }
        $diagnosis_diseases = json_encode($diagnosis_diseases);
        $rooms = Room::whereHas('room_type', function ($query) {
            return $query->where('name', '=', "Service");
        })->whereHas('clinic', function ($query) {
            return $query->whereHas('college', function ($query) {
                return $query->where('id', '=', Auth::user()['college_id']);
            });
        })->get();
        $previous_diagnosis = Diagnosis::where('student_id', $diagnosis['student_id'])->
        where('complete', true)->orWhere('discarded', true)->get();
        $page_title = 'Patient Diagnosis';
        $page_description = 'Diagnosing patient';
        $user = Auth::user();

        return view('pages.clinic.diagnosis.diagnosis_diagnose',
            compact('page_title', 'page_description', 'user',
                'diagnosis', 'diseases', 'symptoms', 'rooms', 'previous_diagnosis',
                'diagnosis_diseases', 'diagnosis_symptoms'));
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

    public function forwardHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'description' => ['required'],
            'service_items' => ['required'],
        ]);

        $diagnosis = Diagnosis::find($data['id']);
        if ($diagnosis == null) {
            return redirect()->route('diagnosis_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Diagnosis ID!']);
        }

        $service_requests = [];
        foreach($data['service_items'] as $item){
            error_log($item);
            $service = Service::find($item);
            if($service == null) continue;
            $exist = false;
            for($id = 0; $id < count($service_requests); $id++){
                $serv_req = $service_requests[$id];
                if($serv_req['room_id'] == $service['room_id']){
                    $service_requests[$id]['service_items'][] = $item;
                    $exist = true;
                    break;
                }
            }
            if(!$exist){
                $item_array =  array($item);
                $service_requests[] = ['room_id'=> $service['room_id'], 'service_items' => $item_array];
            }
            error_log(json_encode($service_requests));
        }
        foreach($service_requests as $serv_req){
            $_data = ['diagnosis_id' => $data['id'],
                'description' => $data['description'],
                'room_id' => $serv_req['room_id']];
            $service_req = ServiceRequest::create($_data);
            $diagnosis['pending_request'] = true;
            foreach($serv_req['service_items'] as $item){
                $_data_ = ['service_request_id' => $service_req['id'],
                    'service_id' => $item,
                    'description' => "",
                    'status' => false];
                $service_req = ServiceRequestItem::create($_data_);
            }
        }
        $diagnosis->save();
       return redirect()->route('diagnosis_NewList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Student information submitted successfully!']);
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
            return redirect()->route('diagnosis_NewList')->with(['notification' => "Error",
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

    public function saveHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'description' => [],
            'diagnosis' => [],
            'symptom_list' => [],
            'disease_list' => [],
        ]);

        $diagnosis = Diagnosis::find($data['id']);
        if ($diagnosis == null) {
            return redirect()->route('diagnosis_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Diagnosis ID!']);
        }

        error_log(json_encode($request->all()));
        if($data['description']){
            $diagnosis['description'] = $data['description'];
        }
        if($data['diagnosis']){
            $diagnosis['diagnosis'] = $data['diagnosis'];
        }
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

        $diagnosis->save();
        return redirect()->route('diagnosis_NewList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Patient information saved successfully!']);
    }
}
