<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function settingPage(){
        return view('pages.setting-page');
    }
}