<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function aboutUs(){
        return view('pages.about-us');
    }
    public function service(){
        return view('pages.service');
    }
    public function process(){
        return view('pages.our-process');
    }
    public function contactUs(){
        return view('pages.contact-us');
    }





   
}
