<?php

namespace App\View\Components;

use App\Models\Clan;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class AllianceDetailPanel extends Component
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
    {
        $clan = Clan::query()->where('chef_id', Auth::guard('appuser')->user()->id)->first();
        $isMyAlliance = false;
        if($clan){
            $isMyAlliance = true;
        }
        $prixUpgradeClan =  100000;
        return view('components.alliance-detail-panel', compact('prixUpgradeClan', 'isMyAlliance', 'clan'));
    }
}
