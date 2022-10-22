<?php

namespace App\Http\Livewire\Admin\BoughtLand;

use App\Models\BoughtLand;
use App\Models\Document;
use Livewire\Component;

class Create extends Component
{
    public $document;
    public $issued_date;

    protected $rules = [
        'document' => ['required', 'string', 'max:255'],
        'issued_date' => ['nullable', 'date']
    ];

    public function submit()
    {
        $this->validate();

        BoughtLand::create([
            'document_id' => $this->document,
            'issued_at' => $this->issued_date
        ]);

        session()->flash('message', 'Land was bought Successfully!');

        $this->redirect(route('boughtlands.index'));
    }

    public function render()
    {
        $boughtDocs = BoughtLand::with(['document'])->get()->pluck('document_id')->toArray();
        return view('livewire.admin.bought-land.create', ['documents' => Document::with('plots')->whereNotIn('id', $boughtDocs)->where('active', 1)->get()]);
    }
}
