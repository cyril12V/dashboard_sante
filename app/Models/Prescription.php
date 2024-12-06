<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    use HasFactory;

    // Spécifie les champs qui peuvent être assignés en masse
    protected $fillable = [
        'user_id',
        'medication_name',
        'dosage',
        'start_date',
        'end_date',
    ];

    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
