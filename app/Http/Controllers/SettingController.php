<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingController extends Controller
{
    //
    public function generalSetting() {
        return view('admin.settings.general');
    }
    public function boutiqueSetting() {
        return view('admin.settings.shop');
    }
    public function chatView() {
        return view('admin.settings.chatlog');
    }
}
