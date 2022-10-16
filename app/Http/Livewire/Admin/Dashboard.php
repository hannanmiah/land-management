<?php

namespace App\Http\Livewire\Admin;

use App\Models\BoughtLand;
use App\Models\Plot;
use Livewire\Component;

class Dashboard extends Component
{
    public function render()
    {
        $totalPlot = Plot::all()->count();
        $remainingPlot = Plot::with('document')->where('status', '!=', 'sold')->get()->count();
        $buysArray = BoughtLand::with(['document'])->get()->pluck('document.amount');
        $totalBuy = $buysArray->reduce(fn($c, $i) => $c + $i, 0);
        $soldArray = Plot::with('document')->where('status', 'sold')->get()->pluck('amount');
        $totalSold = $soldArray->reduce(fn($c, $i) => $c + $i, 0);
        $remainingAmount = $totalBuy - $totalSold;

        return view('livewire.admin.dashboard', ['total_plot' => $totalPlot, 'remaining_plot' => $remainingPlot, 'total_buy' => $totalBuy, 'total_sell' => $totalSold, 'remaining_amount' => $remainingAmount]);
    }
}
