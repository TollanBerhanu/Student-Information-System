<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminPagesController extends Controller
{
    public function index()
    {
        $page_title = 'Admin Dashboard';
        $page_description = 'Some description for the page';
        $user = Auth::user();

        return view('pages.cafe.dashboard', compact('page_title', 'page_description', 'user'));
    }




}
