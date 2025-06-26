<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'status',
        'task_id',
        'date',
    ];

    /**
     * Relationship with Task model.
     */
    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    /**
     * Relationship with Client model.
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected $casts = [
        'date' => 'date', // Cast date to a proper date type for easier management
    ];
}
