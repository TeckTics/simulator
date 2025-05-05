<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Support\Facades\DB;


class ClassementPanel extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $users = DB::select("SELECT users.id AS users_id, users.pseudo, users.experience, users.performance,  COUNT(mission_users.id) as count_mission FROM users  LEFT JOIN mission_users ON users.id = mission_users.user_id GROUP BY users.id,  users.pseudo, users.experience, users.performance, mission_users.id ORDER BY users.performance, users.pseudo, users.experience  ASC");
        return view('components.classement-panel', compact('users'));
    }
}
