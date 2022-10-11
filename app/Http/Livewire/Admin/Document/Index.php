<?php

namespace App\Http\Livewire\Admin\Document;

use App\Models\Document;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = ['destroyed' => 'destroy'];

    public function paginationView()
    {
        return 'pagination.custom';
    }

    public function export($path)
    {
        return Storage::disk('files')->download($path);
    }

    public function destroy($id)
    {
        $doc = Document::with('plots', 'boughts', 'solds')->find($id);
        $doc->plots()->delete();
        $doc->solds()->delete();
        $doc->boughts()->delete();

        $doc->delete();
    }


    public function render()
    {
        return view('livewire.admin.document.index', ['documents' => Document::with(['plots', 'solds', 'boughts'])->latest()->paginate(10)]);
    }
}
