<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Component;

class Cart extends Component
{   
    #[Layout('components.layouts.frontend')]

    public function render()
    {
        return view('livewire.frontend.cart');
    }
}
