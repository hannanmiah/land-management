<?php

namespace App\Http\Livewire\Admin\Setting;

use Livewire\Component;
use Livewire\WithFileUploads;

class Photo extends Component
{
    use WithFileUploads;

    public $photo;

    public function submit()
    {
        $this->validate([
            'photo' => ['required', 'image', 'max:2048']
        ]);

        $url = $this->photo->store('profile', 'photos');

        $user = auth()->user();
        $user->photo = $url;
        $user->save();

        $this->redirect(route('settings.index'));
    }

    public function render()
    {
        return view('livewire.admin.setting.photo', ['user' => auth()->user()]);
    }
}
