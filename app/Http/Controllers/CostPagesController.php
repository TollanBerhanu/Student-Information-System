<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CostPagesController extends Controller
{
    public function index()
    {
        $page_title = 'Cost Dashboard';
        $page_description = 'Some description for the page';
        $user = Auth::user();

        return view('pages.cost.dashboard', compact('page_title', 'page_description', 'user'));
    }
}
