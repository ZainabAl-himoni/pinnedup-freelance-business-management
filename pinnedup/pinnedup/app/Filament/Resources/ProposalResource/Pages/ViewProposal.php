<?php

namespace App\Filament\Resources\ProposalResource\Pages;

use App\Filament\Resources\ProposalResource;
use Barryvdh\DomPDF\PDF;
use Filament\Notifications\Notification;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;
use Illuminate\Support\Facades\Mail;

class ViewProposal extends ViewRecord
{
    protected static string $resource = ProposalResource::class;

    protected function getActions(): array
    {
        return [
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
                ->color('success'),
        ];
    }

    // same methods from EditProposal:
    public function downloadPdf()
    {
        // Redirect to the normal route
        return redirect()->route('proposals.download', $this->record);
    }


    public function viewPdf()
    {
        $proposal = $this->record;

        // Generate PDF
        $pdf = PDF::loadView('pdf.proposal', [
            'proposal' => $proposal,
        ]);

        // Stop Filament from trying to parse/return JSON
        $this->halt();

        // Return inline PDF
        return $pdf->stream("proposal-{$proposal->id}.pdf");
    }


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
