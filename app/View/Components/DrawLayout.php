<?php

namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Raffle;

class DrawLayout extends Component
{

    public $raffle;

    public function __construct(Raffle $raffle)
    {
        $this->raffle = $raffle;
    }

    /**
     * Get the view / contents that represents the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('layouts.draw');
    }
}
