<?php

namespace App\Http\Livewire\Admin\Project;

use App\Models\Project;
use Livewire\Component;

class View extends Component
{
    public Project $project;

    public function mount(){

    }
    public function render()
    {
        return view('livewire.admin.project.view');
    }
}
