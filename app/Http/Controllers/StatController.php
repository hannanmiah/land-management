<?php

namespace App\Http\Controllers;

use App\Models\BoughtLand;
use App\Models\Document;
use App\Models\SoldLand;
use Illuminate\Support\Collection;

class StatController extends Controller
{
    public function plots()
    {

    }

    public function bar()
    {
        $totalAmountArr = [];
        $soldAmountArr = [];
        $boughtDocArray = BoughtLand::with(['document' => fn($query) => $query->where('active', 1)])->get()->pluck('document_id')->toArray();
        $documents = Document::with(['plots', 'boughts'])->whereIn('id', $boughtDocArray)->where('active', 1)->get();
        $soldDocArray = SoldLand::with(['document' => fn($query) => $query->where('active', 1)])->get()->pluck('document_id')->toArray();
        $soldDocuments = Document::with(['solds', 'plots'])->whereIn('id', $soldDocArray)->where('active', 1)->get();
        foreach ($documents as $document) {
            $totalAmountArr[] = [$document->no => $document->amount];
        }
        foreach ($soldDocuments as $document) {
            $soldLandAmount = SoldLand::with(['document'])->where('document_id', $document->id)->get()->pluck('amount');
            $amount = $this->addAmount($soldLandAmount);
            $soldAmountArr[] = [$document->no => $amount];
        }

        return response()->json([
            'buy' => $totalAmountArr,
            'sell' => $soldAmountArr
        ]);
    }

    public function addAmount(Collection $amounts)
    {
        return $amounts->reduce(fn($c, $i) => $c + $i, 0);
    }

    public function pie()
    {
        $totalSell = SoldLand::with(['plot'])->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $totalBuy = BoughtLand::with('document')->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $remaining = $totalBuy - $totalSell;

        return response()->json([
            'Sell' => $totalSell,
            'Buy' => $totalBuy,
            'Remain' => $remaining
        ]);
    }

    public function line()
    {
        $janBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 1)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $febBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 2)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $marBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 3)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $aprBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 4)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $mayBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 5)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $junBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 6)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $julBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 7)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $augBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 8)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $sepBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 9)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $octBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 10)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $novBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 11)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $decBuy = BoughtLand::with(['document'])->whereYear('created_at', now()->year)->whereMonth('created_at', 12)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);

        $buyArray = ['Jan' => $janBuy, 'Feb' => $febBuy, 'Mar' => $marBuy, 'Apr' => $aprBuy, 'May' => $mayBuy, 'Jun' => $junBuy, 'Jul' => $julBuy, 'Aug' => $augBuy, 'Sep' => $sepBuy, 'Oct' => $octBuy, 'Nov' => $novBuy, 'Dec' => $decBuy];

        $janSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 1)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $febSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 2)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $marSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 3)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $aprSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 4)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $maySell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 5)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $junSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 6)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $julSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 7)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $augSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 8)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $sepSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 9)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $octSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 10)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $novSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 11)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        $decSell = SoldLand::with(['plot'])->whereYear('created_at', now()->year)->whereMonth('created_at', 12)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);

        $sellArray = ['Jan' => $janSell, 'Feb' => $febSell, 'Mar' => $marSell, 'Apr' => $aprSell, 'May' => $maySell, 'Jun' => $junSell, 'Jul' => $julSell, 'Aug' => $augSell, 'Sep' => $sepSell, 'Oct' => $octSell, 'Nov' => $novSell, 'Dec' => $decSell];
        return response()->json([
            'buy' => $buyArray,
            'sell' => $sellArray
        ]);
    }

    public function year_line()
    {
        $allSellDateArray = SoldLand::with(['plot'])->orderBy('issued_at')->pluck('issued_at')->map(function ($val) {
            return preg_replace("/-\d\d-\d\d \d\d:\d\d:\d\d.*/", '', $val);
        })->unique();

        $allBuyDateArray = BoughtLand::with(['document'])->orderBy('issued_at')->pluck('issued_at')->map(function ($val) {
            return preg_replace("/-\d\d-\d\d \d\d:\d\d:\d\d.*/", '', $val);
        })->unique()->sort();

        $sellData = [];
        foreach ($allSellDateArray as $date) {
            $sellData[$date] = SoldLand::with(['plot'])->whereYear('issued_at', $date)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        }

        $buyData = [];
        foreach ($allBuyDateArray as $date) {
            $buyData[$date] = BoughtLand::with('document')->whereYear('issued_at', $date)->get()->pluck('amount')->reduce(fn($c, $i) => $c + $i, 0);
        }

        return response()->json([
            'buy' => $buyData,
            'sell' => $sellData
        ]);
    }
}
