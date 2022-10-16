<?php

namespace App\Http\Livewire\Admin\Plot;

use App\Models\BoughtLand;
use App\Models\Document;
use App\Models\Plot;
use App\Models\Project;
use Livewire\Component;

class Create extends Component
{
    public $document;
    public $project;
    public $no;
    public $name;
    public $amount;

    public function submit()
    {
        $this->validate(
            [
                'no' => ['required', 'string', 'max:255', 'unique:plots'],
                'amount' => ['required', 'numeric', 'min:1'],
                'name' => ['required', 'string', 'max:255'],
                'document' => ['required', 'string', 'max:255'],
                'project' => ['required', 'string', 'max:255']
            ]
        );

        Plot::create([
            'no' => $this->no,
            'name' => $this->name,
            'amount' => $this->amount,
            'document_id' => $this->document,
            'project_id' => $this->project
        ]);

        session()->flash('message', 'Plot created Successfully!');

        $this->redirect(route('plots.index'));
    }

    public function updatedAmount()
    {
        $remainingAmount = $this->remainingAmount();

        if ($this->amount > $remainingAmount) {
            $this->amount = $remainingAmount;
        }
    }

    public function remainingAmount()
    {
        if (isset($this->document)) {
            $boughtsArrayAmount = BoughtLand::with('document')->where('document_id', $this->document)->get()->pluck('document.amount');
            $totalBoughts = $boughtsArrayAmount->reduce(fn($c, $i) => $c + $i, 0);
            $soldsArrayAmount = Plot::with(['document'])->where('status', 'sold')->orWhere('status', 'created')->where('document_id', $this->document)->pluck('amount');
            $totalSolds = $soldsArrayAmount->reduce(fn($c, $i) => $c + $i, 0);

            return (double)$totalBoughts - $totalSolds;
        }

        return $this->amount ?? 0;
    }

    public function updatedDocument()
    {
        if (!isset($this->amount)) {
            $this->amount = $this->remainingAmount();
        } elseif ($this->amount > $this->remainingAmount()) {
            $this->amount = $this->remainingAmount();
        }
    }

    public function render()
    {
        $docIds = BoughtLand::with(['document' => function ($query) {
            $query->where('active', 1);
        }])->get()->pluck('document_id')->toArray();
        return view('livewire.admin.plot.create', ['projects' => Project::all(), 'documents' => Document::with(['plots', 'bought'])->whereIn('id', $docIds)->where('active', 1)->get()]);
    }
}
