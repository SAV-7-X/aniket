<?php

namespace App\Livewire\Frontend;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Component;

class Nav extends Component
{
     // Listens for the 'navigationCompleted' event
     public $cartCount = 0;
     public $isLoggedIn = false;
 
     public function mount()
     {
         // Check if user is logged in
         $this->isLoggedIn = auth()->check();
         
         // Get cart count from session or database
         // This is just a placeholder - implement according to your cart system
         if (session()->has('cart')) {
             $this->cartCount = count(session('cart'));
         }
     }
     public function refreshComponent()
     {
         // This will trigger a re-render of the component
         $this->render();
     }

     #[Layout('components.layouts.frontend')]
     public function render()
    {
        return view('livewire.frontend.nav');
    }
}
