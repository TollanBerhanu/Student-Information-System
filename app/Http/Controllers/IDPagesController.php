<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IDPagesController extends Controller
{
    public function index()
    {
        $page_title = 'ID Dashboard';
        $page_description = 'Some description for the page';
        $user = Auth::user();

        return view('pages.id.dashboard', compact('page_title', 'page_description', 'user'));
    }
}
