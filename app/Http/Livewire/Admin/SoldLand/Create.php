<?php

namespace App\Http\Livewire\Admin\SoldLand;

use App\Models\Document;
use App\Models\Plot;
use App\Models\SoldLand;
use Livewire\Component;

class Create extends Component
{
    public $amount;
    public $document;
    public $plot;
    public $statement_no;
    public $issued_date;

    protected $rules = [
        'amount' => ['required', 'numeric', 'min:1'],
        'document' => ['required', 'string', 'max:255'],
        'plot' => ['required', 'string', 'max:255'],
        'statement_no' => ['nullable', 'string', 'max:255'],
        'issued_date' => ['nullable', 'date']
    ];

    public function submit()
    {
        $this->validate();

        SoldLand::create([
            'amount' => $this->amount,
            'document_id' => $this->document,
            'plot_id' => $this->plot,
            'statement_no' => $this->statement_no,
            'issued_at' => $this->issued_date
        ]);

        Plot::with('document')->find($this->plot)->update(['status' => 'sold']);
        session()->flash('message', 'Land sold Successfully!');

        $this->redirect(route('soldlands.index'));
    }

    public function updatedPlot()
    {
        $selectedPlot = Plot::with('document', 'project')->find($this->plot);
        $this->amount = $selectedPlot->amount;

        if (isset($this->document)) {
            $selectedDoc = Document::with('plots')->find($this->document);
            if ($selectedDoc->amount != $this->amount) {
                $this->document = $selectedPlot->document->id;
            }
        }
    }

    public function updatedDocument()
    {
        if (isset($this->amount) && $this->plot) {
            $selectedDoc = Document::with('plots')->find($this->document);
            $selectedPlot = Plot::with('document')->find($this->plot);
            if ($selectedDoc->id != $selectedPlot->document->id) {
                $this->document = $selectedPlot->document->id;
            }

            if ($this->amount != $selectedPlot->amount) {
                $this->amount = $selectedPlot->amount;
            }
        } elseif (isset($this->amount)) {
            $selectedDoc = Document::with('plots')->find($this->document);
            if ($this->amount > $selectedDoc->amount) {
                $this->amount = $selectedDoc->amount;
            }
        }
    }

    public function updatedAmount()
    {
        if (isset($this->plot) && $this->document) {
            $selectedPlot = Plot::with('document')->find($this->plot);

            if ($this->amount != $selectedPlot->amount) {
                $this->amount = $selectedPlot->amount;
            }
        }
    }

    public function render()
    {
        return view('livewire.admin.sold-land.create', ['documents' => Document::with('plots')->where('active', 1)->get(), 'plots' => Plot::with('document')->where('status', '!=', 'sold')->get()]);
    }
}
