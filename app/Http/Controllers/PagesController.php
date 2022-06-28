<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PagesController extends Controller
{
    public function login()
    {
        if(Auth::check()){
            return redirect()->intended('');
        }
        $page_title = 'Login';
        $page_description = 'User authentication page';

        return view('pages.auth.login', compact('page_title', 'page_description'));
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->intended('login');
    }

    public function loginValidate(Request $request): \Illuminate\Http\RedirectResponse
    {

        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ])->onlyInput('email');
    }


    public function index()
    {
        $user = Auth::user();

        $page_title = 'Nature!';
        $page_description = 'Enjoy the view '.$user['first_name'].'!';

        return view('pages.demo.dashboard', compact('page_title', 'page_description', 'user'));
    }

    /**
     * Demo methods below
     */

    // Datatables
    public function datatables()
    {
        $page_title = 'Datatables';
        $page_description = 'This is datatables test page';

        return view('pages.demo.datatables', compact('page_title', 'page_description'));
    }

    // KTDatatables
    public function ktDatatables()
    {
        $page_title = 'KTDatatables';
        $page_description = 'This is KTdatatables test page';

        return view('pages.demo.ktdatatables', compact('page_title', 'page_description'));
    }

    // Select2
    public function select2()
    {
        $page_title = 'Select 2';
        $page_description = 'This is Select2 test page';

        return view('pages.demo.select2', compact('page_title', 'page_description'));
    }

    // Quicksearch Result
    public function quickSearch()
    {
        return view('layout.partials.extras._quick_search_result');
    }
}
