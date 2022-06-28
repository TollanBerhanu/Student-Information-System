<?php

namespace App\Http\Controllers;

use App\Model\Syncable\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CafePagesController extends Controller
{
    public function index()
    {
        $page_title = 'Cafe Dashbodsdard';
        $page_description = 'Some description for the page';
        $user = Auth::user();

        return view('pages.cafe.dashboard', compact('page_title', 'page_description', 'user'));
    }




}
