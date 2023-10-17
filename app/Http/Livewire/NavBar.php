<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class NavBar extends Component
{
    public function render()
    {
        return view('livewire.nav-bar');
    }

   
    public function logout()
    {
        //logout and redirect to login page
        Auth::logout();
        return redirect('/login');
    }
}
