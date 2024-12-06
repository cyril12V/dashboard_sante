<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'last_consultation',
        'average_heart_rate',
        'daily_step_goal',
        'sleep_quality',
        'heart_rate_data',
        'activity_data'
    ];

    // Relation inverse avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
