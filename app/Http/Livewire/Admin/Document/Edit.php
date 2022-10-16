<?php

namespace App\Http\Livewire\Admin\Document;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
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
    public $tempFileArray = [];
    public Document $document;

    public function mount()
    {
        $this->no = $this->document->no;
        $this->doc = Str::before($this->no, '_');
        $this->mutation = Str::after($this->no, '_');
        $this->amount = $this->document->amount;
        $this->owner = $this->document->owner;
        $this->active = $this->document->active;
        $this->additional = $this->document->additional;
        $this->tempFileArray = json_decode($this->document->files);
    }

    public function submit()
    {
        $this->validate([
            'files.*' => ['nullable', 'file', 'max:2048'],
            'no' => ['required', 'string', 'max:255', 'unique:documents,no,' . $this->document->id],
            'doc' => ['required', 'max:155', 'string'],
            'mutation' => ['required', 'max:100', 'string'],
            'amount' => ['required', 'numeric', 'min:1'],
            'owner' => ['required', 'string', 'max:255']
        ]);

        $fileArray = [];

        if (!empty($this->files)) {
            if (!empty($this->tempFileArray && is_array($this->tempFileArray))) {
                $urls = collect($this->tempFileArray)->pluck('url')->toArray();
                Storage::disk('files')->delete($urls);
            }
            foreach ($this->files as $file) {
                $name = $file->getClientOriginalName();
                $url = $file->store('document', 'files');
                $fileArray[] = ['name' => $name, 'url' => $url];
            }
        } else {
            $fileArray = $this->tempFileArray;
        }

        $this->document->update([
            'no' => $this->no,
            'amount' => $this->amount,
            'owner' => $this->owner,
            'additional' => $this->additional,
            'files' => json_encode($fileArray),
            'active' => $this->active ?? 0
        ]);

        $this->emit('updated');
        session()->flash('message', 'Document updated Successfully!');

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
        return view('livewire.admin.document.edit');
    }
}
