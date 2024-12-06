<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HealthAssessment extends Model
{
    protected $fillable = [
        'age',
        'poids',
        'taille',
        'rhesus',
        'allergies',
        'imc',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
