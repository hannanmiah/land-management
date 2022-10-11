<?php

namespace App\Http\Livewire\Admin\BoughtLand;

use App\Models\BoughtLand;
use App\Models\Plot;
use Livewire\Component;
use Livewire\WithPagination;
use Barryvdh\DomPDF\Facade\Pdf;

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
        $bought = BoughtLand::with('document')->findOrFail($id);
        $bought->document()->delete();
        $bought->delete();
    }


    public function remainingAmount($docId)
    {
        $selectedBoughtArr = BoughtLand::with('document')->where('document_id', $docId)->get()->pluck('amount');
        $totalBought = $selectedBoughtArr->reduce(fn($c, $i) => $c + $i, 0);
        $totalSellsArr = Plot::with('document')->where('document_id', $docId)->where('status', 'sold')->get()->pluck('amount');
        $totalSells = $totalSellsArr->reduce(fn($c, $i) => $c + $i, 0);

        return (double)$totalBought - $totalSells;
    }

    public function render()
    {
        return view('livewire.admin.bought-land.index', ['boughts' => BoughtLand::with('document')->latest()->paginate(10)]);
    }
}
