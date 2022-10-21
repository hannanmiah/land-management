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
        return $pdf->download('invoice-document.pdf');
    }

    public function bought()
    {
        $boughts = BoughtLand::with('document')->latest()->paginate(10);
        $pdf = Pdf::loadView('invoice.bought', ['boughts' => $boughts]);
        return $pdf->download('invoice-bought.pdf');
    }

    public function sold()
    {
        $solds = SoldLand::with('plot')->latest()->paginate(10);
        $pdf = Pdf::loadView('invoice.sold', ['solds' => $solds]);
        return $pdf->download('invoice-sold.pdf');
    }

    public function plot()
    {
        $plots = Plot::with(['document', 'sold', 'project'])->latest()->paginate(10);
        $pdf = Pdf::loadView('invoice.plot', ['plots' => $plots]);

        return $pdf->download('invoice-plot.pdf');
    }

    public function project()
    {
        $projects = Project::with(['plots'])->latest()->paginate(10);
        $pdf = Pdf::loadView('invoice.project', ['projects' => $projects]);

        return $pdf->download('invoice-project.pdf');
    }
}
