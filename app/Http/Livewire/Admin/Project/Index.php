<?php

namespace App\Http\Livewire\Admin\Project;

use App\Models\Project;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = ['destroyed' => 'destroy'];

    public function paginationView()
    {
        return 'pagination.custom';
    }

    public function destroy($id)
    {
        $project = Project::with('plots')->findOrFail($id);
        $project->plots()->delete();
        $project->delete();
    }

    public function render()
    {
        return view('livewire.admin.project.index', ['projects' => Project::with('plots')->latest()->paginate(10)]);
    }
}
