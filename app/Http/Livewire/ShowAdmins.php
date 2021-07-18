<?php

namespace App\Http\Livewire;

use App\Models\Admin;
use Livewire\Component;

class ShowAdmins extends Component
{
    public $name, $email, $password, $confirmPassword, $success, $isOpen = false;

    protected $rules = [
        'name'            => 'required|string',
        'email'           => 'required|email|unique:admins,email',
        'password'        => 'required|string|min:8',
        'confirmPassword' => 'required|same:password'
    ];

    public function render()
    {
        return view('livewire.show-admins', ['users' => Admin::latest()->paginate(12)]);
    }

    public function hideForm(): void
    {
        $this->reset();
        $this->resetErrorBag();
        $this->isOpen = false;
    }

    public function showForm(): void
    {
        $this->isOpen = true;
    }

    public function store(): void
    {
        $this->validate();

        Admin::create([
            'name'     => $this->name,
            'password' => bcrypt($this->password),
            'email'    => $this->email
        ]);

        $this->reset();

        $this->success = 'Admin Created Successfully';
        $this->isOpen = false;
    }

    public function destroy(Admin $admin): void
    {
        $admin->users()->update(['approved_by' => null]);
        $admin->entities()->update(['approved_by' => null]);
        $admin->delete();
    }
}
