<?php

namespace App\Filament\Resources\ProposalsResource\Pages;

use App\Filament\Resources\ProposalsResource;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Resources\Pages\ViewRecord;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Actions\Action;
use App\Mail\ProposalMailable;
 use Illuminate\Support\Facades\Mail;

class ViewProposals extends ViewRecord
{
    protected static string $resource = ProposalsResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('downloadPdf')->label('Download PDF')->action('downloadPdf'),
            Action::make('sendEmail')->label('Send Email')->action('sendEmail'),
        ];
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('id')->disabled()->label('Proposal #'),
            Forms\Components\TextInput::make('budget')->disabled()->label('Budget'),
            Forms\Components\Select::make('lead_id')
                ->relationship('lead', 'name')
                ->label('Lead')
                ->disabled(),
            Forms\Components\DatePicker::make('start_date')->disabled()->label('Start Date'),
            Forms\Components\DatePicker::make('deadline')->disabled()->label('Deadline'),
            Forms\Components\Textarea::make('description')->disabled()->label('Proposal Description'),
        ]);
    }

    public function downloadPdf()
    {
        $pdf = PDF::loadView('pdf.proposal', ['proposal' => $this->record]);
        return $pdf->download('proposal-'.$this->record->id.'.pdf');
    }

    public function sendEmail()
    {
        $pdf = PDF::loadView('pdf.proposal', ['proposal' => $this->record]);
        $mail = new ProposalMailable($this->record, $pdf);
        Mail::to('someone@example.com')->send($mail);
        $this->notify('success', 'Proposal emailed successfully.');
    }
}
