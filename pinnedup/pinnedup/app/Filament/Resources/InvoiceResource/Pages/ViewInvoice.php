<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Resources\Pages\ViewRecord;
use Filament\Pages\Actions;
use Filament\Notifications\Notification;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;

class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;

    protected function getActions(): array
    {
        return [
            Actions\Action::make('downloadPdf')
                ->label('Download as PDF')
                ->icon('heroicon-o-arrow-down-circle')
                ->color('primary')
                ->action('redirectToDownload'),

            Actions\Action::make('viewPdf')
                ->label('View as PDF')
                ->icon('heroicon-o-eye')
                ->color('danger')
                ->action('redirectToView'),


            // Send Email
            Actions\Action::make('sendEmail')
                ->label('Send Email')
                ->icon('heroicon-o-paper-airplane')
                ->action('sendEmail')
                ->color('success'),
        ];
    }

    /**
     * Download the invoice as a PDF file.
     */
    public function redirectToDownload()
    {
        // This simply redirects the browser to the route that downloads the PDF
        return redirect()->route('invoices.download', $this->record);
    }

    public function redirectToView()
    {
        // This simply redirects the browser to the route that displays the PDF inline
        return redirect()->route('invoices.view', $this->record);
    }


    /**
     * Send the invoice via Email to the Task's related client (if you have such relation).
     * Adjust to your actual email logic.
     */
    public function sendEmail()
    {
        $invoice = $this->record;

        // For example, if each "task" belongs to a "client" with an email:
        $recipientEmail = $invoice->task->client->email ?? null;

        if (!$recipientEmail) {
            Notification::make()
                ->title('No email found for this task’s client.')
                ->danger()
                ->send();
            return;
        }

        try {
            // Send a simple text email
            Mail::raw('Here is your invoice!', function ($message) use ($recipientEmail, $invoice) {
                $message->to($recipientEmail)
                    ->subject("Invoice #{$invoice->id}");
            });

            // Show success notification
            Notification::make()
                ->title("Invoice sent to {$recipientEmail} successfully!")
                ->success()
                ->send();

        } catch (\Exception $e) {
            // Show error notification
            Notification::make()
                ->title("Failed to send invoice: " . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
