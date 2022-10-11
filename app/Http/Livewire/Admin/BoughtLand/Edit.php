<?php

namespace App\Http\Livewire\Admin\BoughtLand;

use App\Models\BoughtLand;
use App\Models\Document;
use Livewire\Component;

class Edit extends Component
{
    public BoughtLand $bought;
    public $amount;
    public $document;
    public $issued_date;

    public function mount()
    {
        $this->amount = $this->bought->amount;
        $this->document = $this->bought->document->id;
        $this->issued_date = $this->bought->issued_at;
    }

    public function submit()
    {
        $this->validate([
            'amount' => ['required', 'numeric', 'min:1'],
            'document' => ['required', 'string', 'max:255'],
            'issued_date' => ['nullable', 'date']
        ]);

        $this->bought->update([
            'amount' => $this->amount,
            'document_id' => $this->document,
            'issued_at' => $this->issued_date
        ]);

        session()->flash('message', 'Land updated Successfully!');

        $this->redirect(route('boughtlands.index'));
    }

    public function updatedAmount()
    {
        if (isset($this->document)) {
            if ($this->amount > $this->remainingBought()) {
                $this->amount = $this->remainingBought();
            }
        }
    }

    public function remainingBought()
    {
        if ($this->document) {
            $currentDocAmount = $this->checkingDoc()->amount;
            return $currentDocAmount - $this->totalBought();
        }

        return 0;

    }

    public function checkingDoc()
    {
        return Document::with('plots', 'solds', 'boughts')->findOrFail($this->document);
    }

    public function totalBought()
    {
        $totalBoughtsArr = BoughtLand::with('document')
            ->whereNot('id', $this->bought->id)
            ->where('document_id', $this->document)->get()->pluck('amount');
        return $totalBoughtsArr->reduce(fn($c, $i) => $c + $i, 0);
    }

    public function updatedDocument()
    {
        if (isset($this->amount)) {
            if ($this->amount > $this->remainingBought()) {
                $this->amount = $this->remainingBought();
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.bought-land.edit', ['documents' => Document::with('plots')->where('active', 1)->get()]);
    }
}
