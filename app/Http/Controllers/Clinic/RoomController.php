<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use App\Model\Clinic\Clinic;
use App\Model\Clinic\Room;
use App\Model\Clinic\RoomType;
use App\Model\Privilege;
use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoomController extends Controller
{
    public function list()
    {
        $rooms = Room::all();
        $page_title = 'Room List';
        $page_description = 'List of registered rooms';
        $user = Auth::user();

        return view('pages.clinic.room.room_list',
            compact('page_title', 'page_description', 'user', 'rooms'));
    }

    public function newPage()
    {
        $clinics = Clinic::all()->sortBy('name');
        $room_types = RoomType::all()->sortBy('name');
        $page_title = 'Register Room';
        $page_description = 'Register a new room';
        $user = Auth::user();

        return view('pages.clinic.room.room_new',
            compact('page_title', 'page_description', 'user', 'clinics', 'room_types'));
    }

    public function newHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required'],
            'description' => ['required'],
            'clinic_id' => ['required'],
            'room_type_id' => ['required'],
        ]);

        if (Room::where('name', $data['name'])->count() > 0) {
            return back()->withErrors([
                'name' => 'Name already registered.',
            ])->withInput($data);
        }

        $room_type = RoomType::find($data['room_type_id']);
        if (!$room_type) {
            return back()->withErrors([
                'room_type_id' => 'Room Type cannot be None.',
            ])->withInput($data);
        }

        $clinic = Clinic::find($data['clinic_id']);
        if (!$clinic) {
            return back()->withErrors([
                'clinic_id' => 'Clinic cannot be None.',
            ])->withInput($data);
        }
        $data['active'] = true;
        Room::create($data);
        return back()->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Room created successfully!']);
    }

    public function editPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('roomList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $room = Room::find($id);
        if($room == null){
            return redirect()->route('roomList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Room ID!']);
        }
        $clinics = Clinic::all()->sortBy('name');
        $room_types = RoomType::all()->sortBy('name');
        $page_title = 'Edit Room';
        $page_description = 'Update room information';
        $user = Auth::user();


        return view('pages.clinic.room.room_update',
            compact('page_title', 'page_description', 'user', 'room', 'clinics', 'room_types'));
    }

    public function editHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'name' => ['required'],
            'description' => ['required'],
            'clinic_id' => ['required'],
            'room_type_id' => ['required'],
        ]);

        $room = Room::find($data['id']);
        if (!$room) {
            return back()->withErrors([
                'room' => 'Unable to find room in our records.',
            ])->withInput($data);
        }
        $room['description'] = $data['description'];

        if($data['room_type_id'] == -1){
            return back()->withErrors([
                'room_type_id' => 'RoomType cannot be None.',
            ])->withInput($data);
        }
        else if($room['room_type_id'] != $data['room_type_id']){
            $room_type = RoomType::find($data['room_type_id']);
            if (!$room_type) {
                return back()->withErrors([
                    'room_type_id' => 'Invalid RoomType ID',
                ])->withInput($data);
            }
            else{
                $room['room_type_id'] = $room_type->id;
            }
        }

        if($data['clinic_id'] == -1){
            return back()->withErrors([
                'clinic_id' => 'Clinic cannot be None.',
            ])->withInput($data);
        }
        else if($room['clinic_id'] != $data['clinic_id']){
            $clinic = Clinic::find($data['clinic_id']);
            if (!$clinic) {
                return back()->withErrors([
                    'clinic_id' => 'Invalid RoomType ID',
                ])->withInput($data);
            }
            else{
                $room['clinic_id'] = $clinic->id;
            }
        }

        if ($room['name'] != $data['name']) {
            if (Room::where('name', $data['name'])->count() > 0) {
                return back()->withErrors([
                    'name' => 'Name already registered.',
                ])->withInput($data);
            }
            else{
                $room['name'] = $data['name'];
            }
        }
        $room->save();
        return redirect()->route('roomList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Room updated successfully!']);
    }

    public function assignPage(Request $request, $id)
    {
        if ($id == null) {
            return redirect()->route('roomList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Action!']);
        }
        $room = Room::find($id);
        if($room == null){
            return redirect()->route('roomList')->with(['notification' => "Error",
                'alert_type' => "warning",
                'message' => 'Invalid Room ID!']);
        }
        $role = Role::where('name', $room['room_type']['name'])->limit(1)->get();
        $_id = count($role) > 0 ? $role[0]['id'] : -1;
        $users = User::where('college_id', $room['clinic']['college_id'])->where('role_id', $_id)->get();
        $page_title = 'Assign Room';
        $page_description = 'Assign User to room';
        $user = Auth::user();


        return view('pages.clinic.room.room_assign',
            compact('page_title', 'page_description', 'user', 'room', 'users'));
    }

    public function assignHandle(Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->validate([
            'id' => ['required'],
            'user_id' => ['required']
        ]);

        $room = Room::find($data['id']);
        if (!$room) {
            return back()->withErrors([
                'room' => 'Unable to find room in our records.',
            ])->withInput($data);
        }
        if($data['user_id'] == -1){
            return back()->withErrors([
                'user_id' => 'User cannot be None.',
            ])->withInput($data);
        }
        else if($room['user_id'] != $data['user_id']){
            $user = User::find($data['user_id']);
            if (!$user) {
                return back()->withErrors([
                    'user_id' => 'Invalid User ID',
                ])->withInput($data);
            }
            else{
                $room['user_id'] = $user->id;
            }
        }

        $room->save();
        return redirect()->route('roomList')->with(['notification' => "Success", 'alert_type' => "success", 'message' => 'Room updated successfully!']);
    }
}
