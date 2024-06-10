<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('/dashboard', [
            'title' => "Dashboard",
            'main_page' => '',
            'page' => 'Dashboard',
            'data' => 300
        ]);
    }
}
