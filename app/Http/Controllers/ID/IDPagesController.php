<?php

namespace App\Http\Controllers\ID;

use App\Http\Controllers\Controller;
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
