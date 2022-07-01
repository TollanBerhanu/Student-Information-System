<?php

namespace App\Http\Controllers\ID;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Model\Syncable\Student;

class TemporaryIDController extends Controller
{
    public function index()
    {
        $page_title = 'Generate Temporary ID';
        $page_description = '';
        $user = Auth::user();
        $students = Student::all();

        return view('pages.id.temporary', compact('page_title', 'page_description', 'user', 'students'));
    }
}
