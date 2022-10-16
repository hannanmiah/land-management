<?php

namespace App\Http\Livewire\Admin\Document;

use App\Models\Document;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $no;
    public $doc;
    public $mutation;
    public $amount;
    public $owner;
    public $active;
    public $additional;
    public $files;

    protected $rules = [
        'files.*' => ['nullable', 'file', 'max:2048'],
        'doc' => ['required', 'max:155', 'string'],
        'mutation' => ['required', 'max:100', 'string'],
        'no' => ['required', 'string', 'max:255', 'unique:documents'],
        'amount' => ['required', 'numeric', 'min:1'],
        'owner' => ['required', 'string', 'max:255']
    ];

    public function submit()
    {
        $this->validate();

        $fileArray = [];

        if (!empty($this->files)) {
            foreach ($this->files as $file) {
                $name = $file->getClientOriginalName();
                $url = $file->store('document', 'files');
                $fileArray[] = ['name' => $name, 'url' => $url];
            }
        }

        Document::create([
            'no' => $this->no,
            'amount' => $this->amount,
            'owner' => $this->owner,
            'additional' => $this->additional,
            'files' => json_encode($fileArray),
            'active' => $this->active ?? 0
        ]);

        session()->flash('message', 'Document created Successfully!');

        $this->redirect(route('documents.index'));
    }

    public function updatedDoc()
    {
        if (isset($this->mutation)) {
            $this->no = $this->doc . '_' . $this->mutation;
        } else {
            $this->no = $this->doc;
        }
    }

    public function updatedMutation()
    {
        if (isset($this->doc)) {
            $this->no = $this->doc . '_' . $this->mutation;
        } else {
            $this->no = $this->mutation;
        }
    }

    public function render()
    {
        return view('livewire.admin.document.create');
    }
}
