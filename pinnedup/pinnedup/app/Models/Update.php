<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Update extends Model
{
    // Since this is a view, disable timestamps if not present
    public $timestamps = false;

    // Specify the table name (the view)
    protected $table = 'updates';

    // If the view doesn't have an auto-incrementing ID
    public $incrementing = false;

    // Specify the primary key if needed
    protected $primaryKey = 'id';

    // If the primary key is not an integer
    protected $keyType = 'int';

    // Allow mass assignment for all attributes
    protected $guarded = [];
}
