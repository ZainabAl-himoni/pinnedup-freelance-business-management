<?php

namespace App\Filament\Resources\ProposalResource\Pages;

use App\Filament\Resources\ProposalResource;
use App\Models\Proposal;
use Barryvdh\DomPDF\Facade\Pdf;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Mail;

class EditProposal extends EditRecord
{
    protected static string $resource = ProposalResource::class;

    /**
     * Override default Filament actions + add custom ones
     */
    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            // This appears as a button in the Edit page
            Actions\Action::make('downloadPdf')
                ->label('Download as PDF')
                ->icon('heroicon-o-arrow-down-circle')
                ->action('downloadPdf')
                ->color('primary'),

            Actions\Action::make('viewPdf')
                ->label('View as PDF')
                ->icon('heroicon-o-eye')
                ->action('viewPdf')
                ->color('danger'),

            Actions\Action::make('sendEmail')
                ->label('Send Email')
                ->icon('heroicon-c-arrow-turn-right-up')
                ->action('sendEmail')
                ->color('success')
            ,
        ]);
    }

    /**
     * Download the proposal as a PDF file
     */
    public function downloadPdf()
    {
        // Redirect to the normal route
        return redirect()->route('proposals.download', $this->record);
    }

    /**
     * View the proposal as PDF in the browser
     */
    public function viewPdf()
    {
        return redirect()->route('proposals.view-pdf', $this->record);

    }


    /**
     * Send email to the associated lead
     */
    public function sendEmail()
    {
        $proposal = $this->record;
        $leadEmail = $proposal->lead->email ?? null;

        if (!$leadEmail) {
            Notification::make()
                ->title('No email found for this lead.')
                ->danger() // or ->error()
                ->send();

            return;
        }

        // --- Send Email Logic ---
        try {
            Mail::raw('Your proposal is ready!', function ($message) use ($leadEmail) {
                $message->to($leadEmail)
                    ->subject('Proposal Ready');
            });
            Notification::make()
                ->title("Proposal sent to {$leadEmail} successfully!")
                ->success()
                ->send();
        }


        catch (\Exception $e) {
            Notification::make()
                ->title("Proposal sent to {$leadEmail} Failed!".$e->getMessage())
                ->danger()
                ->send();

        }



        // --- Show success notification ---

    }
}
