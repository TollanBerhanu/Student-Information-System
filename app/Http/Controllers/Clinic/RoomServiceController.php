<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Model\Clinic\Service;
use App\Model\Clinic\Room;
use App\Model\Syncable\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomServiceController extends Controller
{
    public function list()
    {
        $room_services = Service::all();
        $page_title = 'Service List';
        $page_description = 'List of registered services';
        $user = Auth::user();

        return view('pages.clinic.roomService.room_service_list',
            compact('page_title', 'page_description', 'user', 'room_services'));
    }

    public function newPage()
    {
        $rooms = Room::whereHas('room_type', function ($query) {
            return $query->where('name', '=', 'Service');
        })->get();
        $page_title = 'Register Service Service';
        $page_description = 'Register a new service';
        $user = Auth::user();

        return view('pages.clinic.roomService.room_service_new',
            compact('page_title', 'page_description', 'user', 'rooms'));
    }

    public function newHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'room_id' => ['required'],
        ]);

        $room = Room::find($data['room_id']);
        if (!$room) {
            return back()->withErrors([
                'room' => 'Room cannot be None.',
            ])->withInput($data);
        }

        Service::create($data);
        return back()->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Service created successfully!']);
    }

    public function editPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('room_ServiceList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $room_service = Service::find($id);
        if($room_service == null){
            return redirect()->route('room_ServiceList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Service ID!']);
        }
        $rooms = Room::whereHas('room_type', function ($query) {
            return $query->where('name', '=', 'Service');
        })->get();
        $page_title = 'Edit Service';
        $page_description = 'Update room information';
        $user = Auth::user();


        return view('pages.clinic.roomService.room_service_update',
            compact('page_title', 'page_description', 'user', 'room_service', 'rooms'));
    }

    public function editHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'room_id' => ['required'],
        ]);

        $service = Service::find($data['id']);
        if (!$service) {
            return back()->withErrors([
                'service' => 'Unable to find service in our records.',
            ])->withInput($data);
        }
        $service['description'] = $data['description'];

        if($data['room_id'] == -1){
            return back()->withErrors([
                'room_id' => 'Room cannot be None.',
            ])->withInput($data);
        }
        else if($service['room_id'] != $data['room_id']){
            $room = Room::find($data['room_id']);
            if (!$room) {
                return back()->withErrors([
                    'room_id' => 'Invalid Room ID',
                ])->withInput($data);
            }
            else{
                $service['room_id'] = $room->id;
            }
        }


        $service->save();
        return redirect()->route('room_ServiceList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Service updated successfully!']);
    }
}
