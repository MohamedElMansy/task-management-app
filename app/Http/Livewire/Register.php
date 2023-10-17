<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $username,$email, $password,$password_confirmation;
    public function render()
    {
        return view('livewire.register')
            ->layout('livewire.layouts.base')
            ->slot('slot');
    }

    public function register()
    {
        
        $this->validate([
            'username' => 'required',
            'email'    => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $user=User::create([
            'name' => $this->username,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
        
        //to auto login after register
        Auth::loginUsingId($user->id);

        return redirect(route('task'));
        
    }
}
