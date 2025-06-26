<?php

namespace App\Observers;

use App\Models\Lead;
use App\Models\Client;

class LeadObserver
{
    /**
     * Handle the Lead "created" event.
     */
    public function created(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "updated" event.
     */
    public function updated(Lead $lead): void
    {
        if ($lead->status == 'converted' && !($lead->client)) {
            // Convert the lead to a client
            $this->convertLeadToClient($lead);
        }
    }

    /**
     * Handle the Lead "deleted" event.
     */
    public function deleted(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "restored" event.
     */
    public function restored(Lead $lead): void
    {
        //
    }

    /**
     * Handle the Lead "force deleted" event.
     */
    public function forceDeleted(Lead $lead): void
    {
        //
    }


    protected function convertLeadToClient(Lead $lead)
    {

        // Create the client based on the lead's details
        $client = Client::create([
            'name' => $lead->name,
            'email' => $lead->email,
            'phone' => $lead->phone,
            'address' => $lead->address,
            'lead_id' => $lead->id, // Associate the client with the lead
            'status' => 'new', // Default status for the new client
            'company_name' => $lead->company_name,
            'source' => $lead->source,
            'tags' => $lead->tags,
        ]);

        // Optionally, update the lead status if needed
        $lead->status = 'converted';
        $lead->save();
        return $client;


    }
}
