<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotaPayments extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_associate',
        'id_quota',
        'amount',
        'expiration_date',
        'issue_date',
        'status',
    ];

    protected $casts = [
        'status' => 'boolean',
    ];

    public function associate()
    {
        return $this->belongsTo(Associate::class, 'id_associate');
    }
}
