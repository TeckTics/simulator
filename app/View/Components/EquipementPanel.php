<?php

namespace App\View\Components;

use App\Models\Personnel_user;
use App\Models\UniteUser;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class EquipementPanel extends Component
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
        $unites = UniteUser::query()
            ->select('type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite',  'unite_users.*', 'unites.image')
            ->join('unites', 'unites.id', '=', 'unite_users.unite_id')
            ->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')
            ->where('unite_users.user_id', Auth::guard('appuser')->user()->id)
            ->get();

        $personnels  = Personnel_user::getPersonnels();

        return view('components.equipement-panel', compact('unites', 'personnels'));
    }
}
