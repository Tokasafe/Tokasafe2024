<?php

namespace App\Http\Livewire\User;


use App\Models\User;
use App\Models\Roles;
use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class Create extends Component
{
    public $username, $name, $roles_id, $password, $email;
    public function render()
    {
        return view('livewire.user.create', [
            "Roles" => Roles::with(['User'])->get()
        ]);
    }
    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'username' => ['required', 'string', 'max:255', 'unique:' . User::class],
            'roles_id' => 'required'
        ]);

        User::create([
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
            'role_users_id' => $this->roles_id,
            'password' => Hash::make($this->password),
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->emit('AddUser');
    }
    public function clearFields()
    {
        $this->name = '';
        $this->username = '';
        $this->roles_id = '';
    }
}
