<?php

namespace App\Http\Controllers\Cafe;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CafePagesController extends Controller
{
    public function index()
    {
        $page_title = 'Cafe Dashbodsdard';
        $page_description = 'Some description for the page';
        $user = Auth::user();

        return view('pages.cafe.commanPage', compact('page_title', 'page_description', 'user'));
    }




}
