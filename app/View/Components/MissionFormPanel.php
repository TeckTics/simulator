<?php

namespace App\View\Components;

use App\Models\BaseUser;
use App\Services\HopitalService;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class MissionFormPanel extends Component
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
    
    
        $hopitalService = resolve(HopitalService::class);

        $base = BaseUser::where('user_id', Auth::guard('appuser')->user()->id)->first();
    
        $closestHospitals = $hopitalService->getCloserToBase($base);
        return view('components.mission-form-panel', compact('closestHospitals'));
    }

}
