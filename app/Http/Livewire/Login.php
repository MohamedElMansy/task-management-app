<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Login extends Component
{
    public $email, $password;
   
    public function render()
    {
        
        return view('livewire.login')
            ->layout('livewire.layouts.base')
            ->slot('slot');
    }

    public function login()
    {
        // validation on email an password when login
        $this->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            return redirect(route('task'));
        }
        //msg in case of invalid login credentials
        session()->flash('message', 'You have entered an invalid username or password');
        return redirect(route('login'));
        
    }
}
