<?php

namespace App\Http\Controllers\Cost;

use App\Http\Controllers\Controller;
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
