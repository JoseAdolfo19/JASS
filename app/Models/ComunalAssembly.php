<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComunalAssembly extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'assembly_date',
        'reason_call',
        'main_agreements',
        'number_attendees',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
