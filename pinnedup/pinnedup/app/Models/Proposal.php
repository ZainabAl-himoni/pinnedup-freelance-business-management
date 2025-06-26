<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proposal extends Model
{
    protected $fillable = [
        'title',
        'features',
        'status',
        'description',
        'lead_id',
        'discount',
        'price',
        'total_price',
        'budget',
        'start_date',
        'deadline',
    ];

    protected $casts = [
        'features' => 'array', // if stored in JSON column
        'start_date' => 'date',
        'deadline' => 'date',
    ];
    public function lead()
    {
        return $this->belongsTo(Lead::class);
    }



}
