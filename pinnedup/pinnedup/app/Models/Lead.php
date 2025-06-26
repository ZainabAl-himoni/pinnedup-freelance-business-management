<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Lead extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'status',
        'company_name',
        'source',
        'tags',
    ];

    public function client()
{
    return $this->hasOne(Client::class);
}


public function proposal()
{
    return $this->hasMany(Proposal::class);
}

protected $casts = [
    'tags' => 'array', 
];

    protected static function booted()
    {
        static::updated(function ($lead) {
            // Check if the status was changed to 'Approved'
            if ($lead->isDirty('status') && $lead->status === 'converted') {
                // Create a client if it doesn't exist
                Client::firstOrCreate(
                    ['email' => $lead->email], // Check by unique email
                    [
                    'name' => $lead->name,
                    'email' => $lead->email,
                    'phone' => $lead->phone,
                    'address' => $lead->address,
                    'lead_id' => $lead->id, // Associate the client with the lead
                    'company_name' => $lead->company_name,
                    'source' => $lead->source,
                    'tags' => $lead->tags,
                        
                    ]
                );
            }
        });
    }
}