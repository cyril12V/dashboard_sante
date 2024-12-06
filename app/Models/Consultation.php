<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'doctor_name',
        'date',
        'prescription',
        'notes',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
