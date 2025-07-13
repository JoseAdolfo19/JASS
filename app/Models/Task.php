<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable=[
        'user_id',
        'description',
        'date_task',
        'type_task',
        'number_participants',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
