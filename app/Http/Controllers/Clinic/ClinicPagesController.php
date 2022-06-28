<?php

namespace App\Http\Controllers\Clinic;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ClinicPagesController extends Controller
{
    public function index()
    {
        $page_title = 'Clinic Dashboard';
        $page_description = 'Some description for the page';
        $user = Auth::user();

        return view('pages.clinic.dashboard', compact('page_title', 'page_description', 'user'));
    }
}
