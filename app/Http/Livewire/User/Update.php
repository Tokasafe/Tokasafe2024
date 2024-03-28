<?php

namespace App\Http\Livewire\User;

use App\Models\User;
use App\Models\Roles;
use Livewire\Component;

class Update extends Component
{
    public $username, $name, $roles_id, $email, $data_id, $openModal = '';
    protected $listeners = [
        'UpdateUsers',
    ];
    public function UpdateUsers($value)
    {
        if (!is_null($value)) {
            $this->data_id = $value;
            $role = User::where('id', $this->data_id)->first();
            $this->name = $role->name;
            $this->username = $role->username;
            $this->email = $role->email;
            $this->roles_id = $role->roles_id;
            $this->openModal = 'modal-open';
        }
    }
    public function render()
    {
        return view('livewire.user.update', [
            "Roles" => Roles::with(['User'])->get()
        ]);
    }
    public function store()
    {
        $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'username' => 'required|min:6|max:255|unique:users,username,' . $this->data_id,
            'email' => 'required|string|email|max:255|unique:users,email,' . $this->data_id,
            'roles_id' => 'required'
        ]);

        User::whereId($this->data_id)->update([
            'username' => $this->username,
            'name' => $this->name,
            'email' => $this->email,
            'role_users_id' => $this->roles_id,
        ]);
        session()->flash('success', 'Data added Successfully!!');
        $this->clearFields();
        $this->outModal();
        $this->emit('AddUser');
    }
    public function clearFields()
    {
        $this->name = '';
        $this->username = '';
        $this->roles_id = '';
    }
    public function outModal()
    {
        $this->openModal = '';
    }
}
