<?php

namespace App\Http\Livewire\Admin\SoldLand;

use App\Models\Document;
use App\Models\Plot;
use App\Models\SoldLand;
use Livewire\Component;

class Create extends Component
{
    public $plot;
    public $statement_no;
    public $issued_date;

    protected $rules = [
        'plot' => ['required', 'string', 'max:255'],
        'statement_no' => ['nullable', 'string', 'max:255'],
        'issued_date' => ['nullable', 'date']
    ];

    public function submit()
    {
        $this->validate();

        SoldLand::create([
            'plot_id' => $this->plot,
            'statement_no' => $this->statement_no,
            'issued_at' => $this->issued_date
        ]);

        Plot::with('document')->find($this->plot)->update(['status' => 'sold']);
        session()->flash('message', 'Land sold Successfully!');

        $this->redirect(route('soldlands.index'));
    }

    public function render()
    {
        return view('livewire.admin.sold-land.create', ['documents' => Document::with('plots')->where('active', 1)->get(), 'plots' => Plot::with('document')->where('status', '!=', 'sold')->get()]);
    }
}
