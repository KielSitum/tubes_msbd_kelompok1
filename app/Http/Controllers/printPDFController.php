<?php

namespace App\Http\Controllers;

use App\Models\InvoiceSelling;
use Barryvdh\DomPDF\PDF;
// use Dompdf\Dompdf;
use Illuminate\Http\Request;

class printPDFController extends Controller
{
    public function generatePdf(Request $request)
    {
        $invoice = InvoiceSelling::where('selling_invoice_id', $request->id)->first();
        $pdf = app(PDF::class);

        $pdf->loadView('view.invoice', $invoice);

        return $pdf->download($invoice->invoice_code.'.pdf');
    }
}
