<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Notifications\Notification;
use Illuminate\Support\Facades\Mail;

class EditInvoice extends EditRecord
{
    protected static string $resource = InvoiceResource::class;

    /**
     * Called immediately after saving the record.
     */
    protected function afterSave(): void
    {
        // If the invoice status is 'Paid', send an email automatically
        if ($this->record->status === 'Paid') {
            $this->sendPaidEmail();
        }
    }

    /**
     * Example method to send the "Paid" email.
     * Adjust to your client or user logic.
     */
    protected function sendPaidEmail()
    {
        $invoice = $this->record;

        // Maybe the same approach as before: find the client’s email
        $recipientEmail = $invoice->task->client->email ?? null;

        if (!$recipientEmail) {
            Notification::make()
                ->title('No email found for this task’s client.')
                ->danger()
                ->send();
            return;
        }

        try {
            Mail::raw("Your invoice #{$invoice->id} has been marked Paid!", function ($message) use ($recipientEmail, $invoice) {
                $message->to($recipientEmail)
                    ->subject("Invoice #{$invoice->id} Paid");
            });

            Notification::make()
                ->title("Paid invoice email sent to {$recipientEmail}!")
                ->success()
                ->send();

        } catch (\Exception $e) {
            Notification::make()
                ->title("Failed to send paid invoice email: " . $e->getMessage())
                ->danger()
                ->send();
        }
    }
}
