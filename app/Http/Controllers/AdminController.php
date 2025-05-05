<?php

namespace App\Http\Controllers;

use App\Models\Clan;
use App\Models\Event;
use App\Models\Mission;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $userCount = User::count();
        $missionCount = Mission::count();
        $evenementCount = Event::count();
        $clanCount = Clan::count();
        $usersOnline = User::query()
        ->where('online', '1')
        ->count();
        return view('admin.home', compact('userCount', 'missionCount', 'evenementCount', 'clanCount', 'usersOnline'));
    }
}
