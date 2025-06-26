<?php

namespace App\Mail;

use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use PDF;

class ProposalMailable extends Mailable
{
    use Queueable;

    public Proposal $proposal;
    public $pdf;

    public function __construct(Proposal $proposal, $pdf)
    {
        $this->proposal = $proposal;
        $this->pdf = $pdf;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Proposal #'.$this->proposal->id
        );
    }

    public function content(): Content
    {
        return new Content(
            markdown: 'emails.proposal'
        );
    }

    public function build()
    {
        return $this
            ->subject('Proposal #'.$this->proposal->id)
            ->attachData($this->pdf->output(), 'proposal-'.$this->proposal->id.'.pdf', [
                'mime' => 'application/pdf',
            ])
            ->view('emails.proposal');
    }
}
