<?php

namespace App\View\Components;

use App\Models\Ville;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SettingPanel extends Component
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
        $villes = Ville::all();
        return view('components.setting-panel', compact('villes'));
    }
}
