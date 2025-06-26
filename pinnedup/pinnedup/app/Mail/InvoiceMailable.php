<?php

namespace App\Mail;

use App\Models\Invoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use PDF;

class InvoiceMailable extends Mailable
{
    use Queueable;

    public Invoice $invoice;
    public $pdf;

    public function __construct(Invoice $invoice, $pdf)
    {
        $this->invoice = $invoice;
        $this->pdf = $pdf;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invoice #'.$this->invoice->id,
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.invoice',
        );
    }

    public function build()
    {
        return $this
            ->subject('Invoice #'.$this->invoice->id)
            ->attachData($this->pdf->output(), 'invoice-'.$this->invoice->id.'.pdf', [
                'mime' => 'application/pdf',
            ])
            ->view('emails.invoice');
    }
}
