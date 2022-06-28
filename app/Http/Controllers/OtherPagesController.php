<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OtherPagesController extends Controller
{
    public function about()
    {
        $page_title = 'About';
        $page_description = 'About page';
        $data = "";

        return view('pages.other.about', compact('page_title', 'page_description', 'data'));
    }
    public function team()
    {
        $page_title = 'Team';
        $page_description = 'Our team page';

        $data = array();
        $data[] = array("name" => "Abu Girma", "image" => "media/team/abu.jpg", "role" => "Developer");
        $data[] = array("name" => "Awol Abdulbasit", "image" => "media/team/awol.jpg", "role" => "Developer");
        $data[] = array("name" => "Bedri Bahru", "image" => "media/team/bedri.jpg", "role" => "Developer");
        $data[] = array("name" => "BiluAilu ", "image" => "media/team/belkis.jpg", "role" => "Developer");
        $data[] = array("name" => "Tollan Sitotaw", "image" => "media/team/tollan.jpg", "role" => "Developer");
        $data[] = array("name" => "Tseganesh", "image" => "media/team/tsega.jpg", "role" => "Developer");

        return view('pages.other.team', compact('page_title', 'page_description', 'data'));
    }
    public function contact()
    {
        $page_title = 'Contact';
        $page_description = 'Contact page';
        $data = "";

        return view('pages.other.contact', compact('page_title', 'page_description', 'data'));
    }
}
