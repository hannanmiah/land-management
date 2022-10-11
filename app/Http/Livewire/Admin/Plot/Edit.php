<?php

namespace App\Http\Livewire\Admin\Plot;

use App\Models\BoughtLand;
use App\Models\Document;
use App\Models\Plot;
use App\Models\Project;
use Livewire\Component;

class Edit extends Component
{
    public Plot $plot;
    public $amount;
    public $document;
    public $no;
    public $name;
    public $project;

    public function mount()
    {
        $this->name = $this->plot->name;
        $this->no = $this->plot->no;
        $this->amount = $this->plot->amount;
        $this->document = $this->plot->document->id;
        $this->project = $this->plot->project->id;
    }

    public function submit()
    {
        $this->validate([
            'no' => ['required', 'string', 'max:255', 'unique:plots,no,' . $this->plot->id],
            'amount' => ['required', 'numeric', 'min:1'],
            'name' => ['required', 'string'],
            'document' => ['required', 'string'],
            'project' => ['required', 'string']
        ]);

        $this->plot->update([
            'no' => $this->no,
            'name' => $this->name,
            'amount' => $this->amount,
            'document_id' => $this->document,
            'project_id' => $this->project
        ]);

        session()->flash('message', 'Plot updated Successfully!');

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
            $boughtsArrayAmount = BoughtLand::with('document')->where('document_id', $this->document)->get()->pluck('amount');
            $totalBoughts = $boughtsArrayAmount->reduce(fn($c, $i) => $c + $i, 0);
            $soldsArrayAmount = Plot::with('document')->where('document_id', $this->document)->get()->pluck('amount');
            $totalSolds = $soldsArrayAmount->reduce(fn($c, $i) => $c + $i, 0);

            return $totalBoughts - $totalSolds;
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

    public function isSold()
    {
        return $this->plot->status == 'sold';
    }

    public function render()
    {
        return view('livewire.admin.plot.edit', ['projects' => Project::all(), 'documents' => Document::with(['plots'])->where('active', 1)->get()]);
    }
}
