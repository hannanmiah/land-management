<?php

namespace App\Http\Livewire\Admin\Plot;

use App\Models\Plot;
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
        $plot = Plot::with('document', 'project')->findOrFail($id);
        $plot->delete();
    }

    public function render()
    {
        return view('livewire.admin.plot.index', ['plots' => Plot::with(['project', 'document'])->latest()->paginate(10)]);
    }
}
