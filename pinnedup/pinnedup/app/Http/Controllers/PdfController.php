<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Proposal;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class PdfController extends Controller
{
    public function view(Proposal $proposal)
    {
        // Generate PDF
        $pdf = PDF::loadView('pdf.proposal', [
            'proposal' => $proposal,
        ]);

        // Return inline PDF
        return $pdf->stream("proposal-{$proposal->id}.pdf");
    }
    public function download(Proposal $proposal)
    {
        $pdf = Pdf::loadView('pdf.proposal', compact('proposal'));
        return $pdf->download("proposal-{$proposal->id}.pdf");
    }
    public function idownload(Invoice $invoice)
    {
        // Generate the PDF
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));

        // Return a standard Laravel "download" response
        return $pdf->download("invoice-{$invoice->id}.pdf");
    }

    /**
     * View the invoice as a PDF in the browser (inline).
     */
    public function iview(Invoice $invoice)
    {
        // Generate the PDF
        $pdf = Pdf::loadView('pdf.invoice', compact('invoice'));

        // Return an "inline" PDF in the browser
        return $pdf->stream("invoice-{$invoice->id}.pdf");
    }

}
