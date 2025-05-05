<?php

namespace App\Http\Controllers;

use App\Models\ParametreGeneral;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    
    //
    public function index()
    {
        $setting = ParametreGeneral::find(1);
        return view('index', compact('setting'));
    }

    public function viewMentionLegal()
    {
        $setting = ParametreGeneral::find(1);
        return view('mentions', compact('setting'));
    }

    public function viewCondition()
    {
        $setting = ParametreGeneral::find(1);
        return view('conditions', compact('setting'));
    }

    public function viewFaq()
    {
        $setting = ParametreGeneral::find(1);
        return view('faq', compact('setting'));
    }
}
