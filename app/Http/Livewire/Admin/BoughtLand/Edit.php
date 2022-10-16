<?php

namespace App\Http\Livewire\Admin\BoughtLand;

use App\Models\BoughtLand;
use App\Models\Document;
use Livewire\Component;

class Edit extends Component
{
    public BoughtLand $bought;
    public $document;
    public $issued_date;

    public function mount()
    {
        $this->document = $this->bought->document->id;
        $this->issued_date = $this->bought->issued_at;
    }

    public function submit()
    {
        $this->validate([
            'document' => ['required', 'string', 'max:255'],
            'issued_date' => ['nullable', 'date']
        ]);

        $this->bought->update([
            'document_id' => $this->document,
            'issued_at' => $this->issued_date
        ]);

        session()->flash('message', 'Land updated Successfully!');

        $this->redirect(route('boughtlands.index'));
    }

    public function render()
    {
        return view('livewire.admin.bought-land.edit', ['documents' => Document::with('plots')->where('active', 1)->get()]);
    }
}
