<?php

namespace App\Http\Livewire\Admin\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $location;
    public $photo;

    protected $rules = [
        'name' => ['required', 'max:255'],
        'location' => ['nullable','string','max:255'],
        'photo' => ['nullable', 'image', 'max:2048']
    ];

    public function submit()
    {
        $this->validate();

        $photoUrl = '';

        if ($this->photo) {
            $photoUrl = $this->photo->store('project', 'photos');
        }

        Project::create([
            'name' => $this->name,
            'location' => $this->location,
            'photo' => $photoUrl
        ]);

        session()->flash('message', 'Project created Successfully!');

        $this->redirect(route('projects.index'));
    }

    public function render()
    {
        return view('livewire.admin.project.create');
    }
}
