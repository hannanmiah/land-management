<?php

namespace App\Http\Livewire\Admin\BoughtLand;

use App\Models\BoughtLand;
use App\Models\Plot;
use Livewire\Component;

class View extends Component
{
    public BoughtLand $bought;

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
        return view('livewire.admin.bought-land.view');
    }
}
