<?php

namespace App\Http\Controllers\Admin;

class PageController extends Controller
{

    public function login()
    {
        return view('login');

    }

    public function register()
    {
        return view('register');
    }

    public function home()
    {

        return view('home');

    }


}
