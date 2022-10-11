<?php

namespace App\Http\Livewire\Admin\SoldLand;

use App\Models\Document;
use App\Models\Plot;
use App\Models\SoldLand;
use Livewire\Component;

class Edit extends Component
{
    public SoldLand $sold;
    public $amount;
    public $document;
    public $plot;
    public $issued_date;
    public $statement_no;

    protected $rules = [
        'issued_date' => ['nullable', 'date'],
        'statement_no' => ['nullable', 'string', 'max:255']
    ];

    public function mount()
    {
        $this->amount = $this->sold->amount;
        $this->plot = $this->sold->plot->id;
        $this->document = $this->sold->document->id;
        $this->statement_no = $this->sold->statement_no;
        $this->issued_date = $this->sold->issued_at;
    }

    public function submit()
    {
        $this->validate();

        $this->sold->update([
            'issued_at' => $this->issued_date,
            'statement_no' => $this->statement_no
        ]);

        session()->flash('message', 'Land updated Successfully!');

        $this->redirect(route('soldlands.index'));
    }

    public function render()
    {
        return view('livewire.admin.sold-land.edit', ['documents' => Document::with('plots')->where('active', 1)->get(), 'plots' => Plot::with('document')->where('status', '!=', 'sold')->get()]);
    }
}
