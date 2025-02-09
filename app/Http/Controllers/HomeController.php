<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    // Constructor is empty now
    // Middleware is removed from here

    public function index()
    {
        return view('home'); // Ensure 'home.blade.php' exists in resources/views/
    }
}
