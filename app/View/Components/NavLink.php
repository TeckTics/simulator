<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavLink extends Component
{
    /**
     * Create a new component instance.
     */
    public $label;
    public $link;
    public $image;
    public $active;

    public function __construct($link, $label, $image, $active)
    {
        //
        $this->link = $link;
        $this->label = $label;
        $this->image = $image;
        $this->active = $active;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.nav-link');
    }
}
