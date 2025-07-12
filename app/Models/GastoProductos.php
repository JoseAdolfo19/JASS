<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GastoProductos extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description_product',
        'supplier',
        'amount',
        'total_cost',
        'date_buy',
    ];
    
}
