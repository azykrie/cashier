<?php

namespace App\Livewire\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Table extends Component
{
    public $name;
    public $email;
    public $password;
    public $role;
    public $user_id;
    public $search;
    use WithPagination;

    public function create()
    {
        $data = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'role' => 'required',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);
        session()->flash('success', 'User has been created successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function edit($id)
    {
        $user = User::where('id', $id)->first();
        $this->user_id = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->password = $user->password;
        $this->role = $user->role;

        $this->dispatch('show-edit-user-modal');
    }

    public function update()
    {
        $data = $this->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:3',
            'role' => 'required',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::where('id', $this->user_id)->update($data);
        session()->flash('message', 'User has been updated successfully');
        $this->resetInput();
        $this->dispatch('close-modal');
    }

    public function delete($id)
    {
        User::find($id)->delete();
    }

    public function resetInput()
    {
        $this->reset('name', 'email', 'role', 'password');
    }

    public function render()
    {
        return view('livewire.user.table', [
            'users' => User::latest()->where('name', 'like', "%{$this->search}%")->paginate(5)
        ]);
    }
}
