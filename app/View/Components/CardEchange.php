<?php

namespace App\View\Components;

use App\Models\UniteUser;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardEchange extends Component
{
    /**
     * Create a new component instance.
     */
    public $uniteId;
    public $id;
    public $uniteSenderId;
    public $pseudo;

    public $unite;
    public $myUnite;

    // * @param string $type
    // * @param string $message
    // * @return void

    public function __construct($uniteId, $uniteSenderId, $pseudo, $id)
    {
        $this->uniteId = $uniteId;
        $this->uniteSenderId = $uniteSenderId;
        $this->pseudo = $pseudo;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     */

    public function render(): View|Closure|string
    {
        $this->unite = UniteUser::join('unites', 'unites.id', '=', 'unite_users.unite_id')->find($this->uniteId);
        $this->myUnite = UniteUser::join('unites', 'unites.id', '=', 'unite_users.unite_id')->find($this->uniteSenderId);
        return view('components.card-echange');
    }
}
