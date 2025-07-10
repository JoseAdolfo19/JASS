<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Associate extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'dni',
        'address_house',
        'housing_registration',
        'status',
    ];
    protected $casts = [
        'status' => 'boolean',
    ];
}
