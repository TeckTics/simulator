<?php

namespace App\View\Components;

use App\Models\Clan;
use App\Models\ParametreJeu;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\Component;

class AlliancePanel extends Component
{
    /**
     * Create a new component instance.
     */
  
    public function __construct()
    {
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {  $settingsGame = ParametreJeu::find(1);
        $clan = Clan::query()->where('chef_id', Auth::guard('appuser')->user()->id)->first();
        $prix = $settingsGame->prix_clan;
        return view('components.alliance-panel', compact('prix', 'clan'));
    }
}
