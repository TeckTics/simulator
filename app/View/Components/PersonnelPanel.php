<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Personnel_user;
use Illuminate\Support\Facades\Auth;

class PersonnelPanel extends Component
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
        $personnels  = Personnel_user::query()
            ->select( 'personnels.image',  'personnel_users.*') // 'personnels.titre_personnel', 
            ->join('personnels', 'personnels.id', '=', 'personnel_users.personnel_id')
            ->where('personnel_users.user_id', Auth::guard('appuser')->user()->id)
            ->get();
        return view('components.personnel-panel', compact('personnels'));
    }
}
