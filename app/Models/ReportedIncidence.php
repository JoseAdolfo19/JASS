<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReportedIncidence extends Model
{
    use HasFactory;

    protected $fillable =[
        'id_associates',
        'description',
        'type_incidence',
        'date_reported',
        'date_resolved',
        'location',
        'repair_cost',
        'status',
        
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function associate()
    {
        return $this->belongsTo(Associate::class, 'id_associates');
    }
}
