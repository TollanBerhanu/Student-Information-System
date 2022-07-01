<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Model\Clinic\Diagnosis;
use App\Model\Clinic\DiagnosisDisease;
use App\Model\Clinic\DiagnosisSymptom;
use App\Model\Clinic\Disease;
use App\Model\Clinic\Room;
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
        })->where('accepted', false)->get();
        $page_title = 'Clinic Diagnosis Request List ';
        $page_description = 'Student Diagnosis request list';
        $user = Auth::user();

        return view('pages.clinic.diagnosis.diagnosis_new_list',
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
        $rooms = Room::whereHas('room_type', function ($query) {
            return $query->where('name', '=', "Service");
        })->whereHas('clinic', function ($query) {
            return $query->whereHas('college', function ($query) {
                return $query->where('id', '=', Auth::user()['college_id']);
            });
        })->get();
        $previous_diagnosis = Diagnosis::where('student_id', $diagnosis['student_id'])->
        where('complete', true)->orWhere('discarded', true)->get();
        error_log($previous_diagnosis);
        $page_title = 'Patient Diagnosis';
        $page_description = 'Diagnosing patient';
        $user = Auth::user();

        return view('pages.clinic.diagnosis.diagnosis_diagnose',
            compact('page_title', 'page_description', 'user',
                'diagnosis', 'diseases', 'symptoms', 'rooms', 'previous_diagnosis'));
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
