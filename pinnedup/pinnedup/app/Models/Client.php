<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Client extends Model
{   use HasFactory;
    protected $fillable = [ 'name',
    'email',
    'phone',
    'address',
    'lead_id',
    'status',
    'company_name',
    'source',
    'tags',];

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function lead()
{
    return $this->belongsTo(Lead::class);
}

    public function scopeConvertedFromLeads($query)
    {
        return $query->whereNotNull('lead_id'); 
    }


    public function invoice()
    {
        return $this->hasMany(Invoice::class);
    }


    protected $casts = [
        'tags' => 'array', 
    ];

}
