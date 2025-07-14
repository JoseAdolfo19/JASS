<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidence extends Model
{
    use HasFactory;

    protected $fillable = [
        'associate_id',
        'description',
        'location',
        'date_reported',
        'date_resolved',
        'type_incidence',
        'repair_cost',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function associate()
    {
        return $this->belongsTo(Associate::class);
    }
}
