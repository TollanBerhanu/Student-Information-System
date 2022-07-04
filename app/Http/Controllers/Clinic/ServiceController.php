<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Model\Clinic\Diagnosis;
use App\Model\Clinic\DiagnosisDisease;
use App\Model\Clinic\DiagnosisSymptom;
use App\Model\Clinic\Disease;
use App\Model\Clinic\Room;
use App\Model\Clinic\ServiceRequest;
use App\Model\Clinic\ServiceRequestItem;
use App\Model\Clinic\Symptom;
use App\Model\Syncable\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServiceController extends Controller
{
    public function newList(Request $request)
    {
        $service_requests = ServiceRequest::whereHas('room', function ($query) {
            return $query->where('user_id', '=', Auth::user()['id']);
        })->where('accepted', false)->get();
        $page_title = 'Clinic Service Request List ';
        $page_description = 'Diagnosis Service request list';
        $user = Auth::user();

        return view('pages.clinic.service.service_new_list',
            compact('page_title', 'page_description', 'user', 'service_requests'));
    }

    public function pendingList(Request $request)
    {
        $service_requests = ServiceRequest::whereHas('room', function ($query) {
            return $query->where('user_id', '=', Auth::user()['id']);
        })->where('accepted', true)->where('complete', false)->get();
        $page_title = 'Clinic Service Request List ';
        $page_description = 'Diagnosis Service request list';
        $user = Auth::user();

        return view('pages.clinic.service.service_pending_list',
            compact('page_title', 'page_description', 'user', 'service_requests'));
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
        $service_request = ServiceRequest::find($id);
        if ($service_request == null) {
            return redirect()->route('service_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Service Request ID!']);
        }
        $page_title = 'Service';
        $page_description = 'service for patient';
        $user = Auth::user();

        $data_array = array();
        foreach($service_request['service_request_items'] as $item){
            $data_array[$item['id']] = [];
            $data_array[$item['id']]['id'] = $item['id'];
            $data_array[$item['id']]['description'] = "";
            $data_array[$item['id']]['status'] = false;
        }
        $data_array = \GuzzleHttp\json_encode($data_array);

        return view('pages.clinic.service.service_serve',
            compact('page_title', 'page_description', 'user', 'service_request', 'data_array'));
    }

    public function completeHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'response' => ['required'],
            'service_item_data' => ['required'],
        ]);

        $service_request = ServiceRequest::find($data['id']);
        if ($service_request == null) {
            return redirect()->route('service_NewList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Service Request ID!']);
        }

        $service_request['response'] = $data['response'];

        $service_item_data = collect(\GuzzleHttp\json_decode($data['service_item_data'], true));

        foreach($service_item_data as $item){
            $service_request_item = ServiceRequestItem::find($item['id']);
            if ($service_request_item != null) {
                $service_request_item['description'] = $item['description'];
                $service_request_item['status'] = $item['status'];
                $service_request_item['complete'] = true;
                $service_request_item->save();
            }
        }
        $service_request['complete'] = true;
        $service_request->save();
        return redirect()->route('service_NewList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Patient information submitted successfully!']);
    }
}
