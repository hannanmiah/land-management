<?php

namespace App\Http\Controllers;

use App\Models\BoughtLand;
use App\Models\Document;
use App\Models\Plot;
use App\Models\Project;
use App\Models\SoldLand;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function document()
    {
        $documents = Document::with(['plots', 'bought'])->latest()->paginate(10);
        $pdf = Pdf::loadView('invoice.document', ['documents' => $documents]);
        $fileName = 'invoice-document-' . now()->format('m-d-Y H:i') . '.pdf';
        return $pdf->download($fileName);
    }

    public function bought()
    {
        $boughts = BoughtLand::with('document')->latest()->paginate(10);
        $pdf = Pdf::loadView('invoice.bought', ['boughts' => $boughts]);
        $fileName = 'invoice-bought-' . now()->format('m-d-Y H:i') . '.pdf';
        return $pdf->download($fileName);
    }

    public function sold()
    {
        $solds = SoldLand::with('plot')->latest()->paginate(10);
        $pdf = Pdf::loadView('invoice.sold', ['solds' => $solds]);
        $fileName = 'invoice-sold-' . now()->format('m-d-Y H:i') . '.pdf';
        return $pdf->download($fileName);
    }

    public function plot()
    {
        $plots = Plot::with(['document', 'sold', 'project'])->latest()->paginate(10);
        $pdf = Pdf::loadView('invoice.plot', ['plots' => $plots]);
        $fileName = 'invoice-plot-' . now()->format('m-d-Y H:i') . '.pdf';
        return $pdf->download($fileName);
    }

    public function project()
    {
        $projects = Project::with(['plots'])->latest()->paginate(10);
        $pdf = Pdf::loadView('invoice.project', ['projects' => $projects]);
        $fileName = 'invoice-project-' . now()->format('m-d-Y H:i') . '.pdf';
        return $pdf->download($fileName);
    }
}
