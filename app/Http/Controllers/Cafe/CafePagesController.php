<?php

namespace App\Http\Controllers\Cafe;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Model\Cafe\Cafe;

class CafePagesController extends Controller
{
    public function index()
    {
        $page_title = 'Cafe Commen Page';
        $page_description = 'Some description for the page';
        $user = Auth::user();

        return view('pages.cafe.commanPage', compact('page_title', 'page_description', 'user'));
    }
    // this is the function that return the cafe admin dashboards
    public function cafeDashboard(){
        $page_title = 'Cafe Admin Dashbodsdard';
        $page_description = '';
        $user = Auth::user();

        return view('pages.cafe.cafeAdminDashboard', compact('page_title', 'page_description', 'user'));
    }
    public function cafe_register(){
        $page_title = 'Cafe Registration And Update';
        $page_description = '';
        $user = Auth::user();
        $All_Cafe_List=Cafe::all();
        return view('pages.cafe.register_update_cafe', compact('page_title', 'page_description', 'user','All_Cafe_List'));
    }



}
