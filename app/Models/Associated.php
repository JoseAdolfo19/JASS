<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Associated extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'housing_address',
        'registration_date',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];
}
