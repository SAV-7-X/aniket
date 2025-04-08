<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class Dashboard extends Component
{
    public function logout()
    {
        Auth::logout(); // Logs out the user
        Session::flush(); // Clears session data

        return redirect('/login'); // Redirect to login page
    }
    public function render()
    {
        return view('livewire.dashboard');
    }
}
