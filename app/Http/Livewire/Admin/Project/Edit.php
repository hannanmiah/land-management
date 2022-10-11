<?php

namespace App\Http\Livewire\Admin\Project;

use App\Models\Project;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public Project $project;
    public $name;
    public $location;
    public $photo;
    public $tempPhoto;

    public function mount()
    {
        $this->name = $this->project->name;
        $this->location = $this->project->location;
        $this->tempPhoto = $this->project->photo;
    }

    public function submit()
    {
        $this->validate([
            'name' => ['required', 'max:255'],
            'location' => ['nullable', 'string', 'max:255'],
            'photo' => ['nullable', 'image', 'max:2048']
        ]);

        if ($this->photo) {
            if ($this->tempPhoto) {
                Storage::disk('photos')->delete($this->tempPhoto);
            }
            $this->tempPhoto = $this->photo->store('project', 'photos');
        }

        $this->project->update([
            'name' => $this->name,
            'location' => $this->location,
            'photo' => $this->tempPhoto
        ]);

        session()->flash('message', 'Project updated Successfully!');

        $this->redirect(route('projects.index'));
    }

    public function render()
    {
        return view('livewire.admin.project.edit');
    }
}
