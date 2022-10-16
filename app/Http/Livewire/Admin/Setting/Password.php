<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;

class Password extends Component
{
    public $password;
    public $password_confirmation;

    public function submit()
    {
        $this->validate([
            'password' => ['required', 'min:8', 'max:255', 'confirmed']
        ]);

        $user = auth()->user();
        $user->password = bcrypt($this->password);
        $user->save();

        $this->redirect(route('settings.index'));
    }

    public function render()
    {
        return view('livewire.admin.setting.password');
    }
}
