<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'client_id',
        'start_date',
        'deadline',
        'status',
        'priority',
        'tags',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    protected $casts = [
        'start_date' => 'date',
        'deadline' => 'date',
        'tags' => 'array', // Cast tags to array for easier management
    ];


    public function task() {

        return $this -> hasMany(Task::class);
    }
    public function tasks()
    {
        return $this->hasMany(Task::class, 'project_id');
    }

}