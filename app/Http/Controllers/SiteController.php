<?php

namespace App\Http\Controllers;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.index');
    }
    
    public function docs()
    {
        return view('site.docs');
    }
}
