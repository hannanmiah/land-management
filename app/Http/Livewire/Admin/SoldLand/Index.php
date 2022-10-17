<?php

namespace App\Http\Livewire\Admin\SoldLand;

use App\Models\SoldLand;
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
        $sold = SoldLand::with(['plot'])->findOrFail($id);
        $sold->delete();
    }

    public function render()
    {
        return view('livewire.admin.sold-land.index', ['solds' => SoldLand::with(['plot'])->latest()->paginate(10)]);
    }
}
