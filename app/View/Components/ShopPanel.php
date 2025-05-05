<?php

namespace App\View\Components;

use App\Models\equipement;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\TypeUnite;
use App\Models\Unite;
use App\Models\Personnel;
class ShopPanel extends Component
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
        $typeUnites = TypeUnite::all();
        $unites = Unite::query()->select('unites.*', 'type_unites.image as icon', 'type_unites.nom_type_unite', 'type_unites.description_type_unite')->join('type_unites', 'type_unites.id', '=', 'unites.type_unite_id')->get();
        $personnels = Personnel::getPublished();
        // if($personnels != null && count($personnels)> 1) {
        //     $personnels = [$personnels[0]];
        // }
        // dd($personnels);
        $equipements = equipement::all();
        return view('components.shop-panel', compact('typeUnites', 'unites', 'personnels', 'equipements'));
    }
}
