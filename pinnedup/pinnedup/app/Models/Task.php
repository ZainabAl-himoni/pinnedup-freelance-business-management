<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'project_id',
        'start_date',
        'deadline',
        'status',
    ];

    public function client()
{
    return $this->belongsTo(Client::class);
}


    public function invoice()
    {
        return $this->hasOne(Invoice::class);
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    protected $casts = [
        'start_date' => 'date',
        'deadline' => 'date',
 ]; }

