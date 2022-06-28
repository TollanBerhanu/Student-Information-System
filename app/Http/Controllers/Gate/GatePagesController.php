<?php

namespace App\Http\Controllers\Gate;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GatePagesController extends Controller
{
    public function index()
    {
        $page_title = 'Gate Dashboard';
        $page_description = 'Some description for the page';
        $user = Auth::user();

        return view('pages.gate.dashboard', compact('page_title', 'page_description', 'user'));
    }
}
