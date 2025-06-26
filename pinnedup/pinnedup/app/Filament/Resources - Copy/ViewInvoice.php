<?php

namespace App\Filament\Resources11;

use App\Mail\InvoiceMailable;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Pages\Actions;
use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Mail;

class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
            Action::make('downloadPdf')->label('Download PDF')->action('downloadPdf'),
            Action::make('sendEmail')->label('Send Email')->action('sendEmail'),
        ];
    }

    public function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\Section::make('Invoice')->schema([
                Forms\Components\TextInput::make('id')->disabled()->label('Invoice #'),
                Forms\Components\TextInput::make('amount')->disabled()->label('Amount'),
                Forms\Components\TextInput::make('status')->disabled()->label('Status'),
                Forms\Components\TextInput::make('task.name')->disabled()->label('Task'),
                Forms\Components\DatePicker::make('date')->disabled()->label('Date'),
            ]),
        ]);
    }

    public function downloadPdf()
    {
        $options = new \Dompdf\Options();
        $options->set('defaultFont', 'DejaVu Sans');

        $pdf = \PDF::loadView('pdf.invoice', [
            'invoice' => $this->record,
        ])->setOptions($options);

        return $pdf->download('invoice-'.$this->record->id.'.pdf');
    }

    public function sendEmail()
    {
        $pdf = PDF::loadView('pdf.invoice', ['invoice' => $this->record]);
        $email = new InvoiceMailable($this->record, $pdf);
        $recipient = 'someone@example.com';
        Mail::to($recipient)->send($email);
        $this->notify('success', 'Invoice emailed successfully.');
    }
}
