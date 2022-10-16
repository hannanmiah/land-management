<?php

namespace App\Http\Livewire\Admin\Document;

use App\Models\Document;
use App\Models\Plot;
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
        $doc->delete();
    }

    public function remaining($docId)
    {
        $currentAmount = Document::with(['bought'])->findOrFail($docId)->amount;
        $soldAmount = Plot::with(['sold'])->where('document_id', $docId)->where('status', 'sold')->get()->pluck('amount')->sum();

        return (double)$currentAmount - $soldAmount;
    }


    public function render()
    {
        return view('livewire.admin.document.index', ['documents' => Document::with(['plots', 'bought'])->latest()->paginate(10)]);
    }
}
