<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\UniteUser;
use Illuminate\Support\Facades\Auth;

class CardBase extends Component
{
    /**
     * Create a new component instance.
     */

    public $uniteUser;
    public $uniteBase;
    public $baseId;

    public function __construct($baseId)
    {
        //
        $this->baseId = $baseId;
        
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $this->uniteUser = UniteUser::where('user_id', Auth::guard('appuser')->user()->id)->get();
        $this->uniteBase = UniteUser::where('base_id', $this->baseId)->get();

        return view('components.card-base');
    }
}
