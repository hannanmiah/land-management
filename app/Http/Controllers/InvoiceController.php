<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class InvoiceController extends Controller
{
    public function bought()
    {
        $pdf = Pdf::loadView('invoice.bought');
        return $pdf->download('invoice-bought.pdf');
    }
}
