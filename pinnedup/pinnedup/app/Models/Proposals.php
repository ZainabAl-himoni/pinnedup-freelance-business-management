<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proposals extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'budget',
        'description',
        'lead_id',
        'start_date',
        'deadline',
    ];

    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }

    protected $casts = [
        'start_date' => 'date',
        'deadline' => 'date',
    ];
    
    /**
     * A Proposal belongs to one Lead.
     */

}
