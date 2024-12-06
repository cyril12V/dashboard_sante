<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relation avec le tableau de bord
    public function dashboard()
    {
        return $this->hasOne(Dashboard::class);
    }

    // Méthode pour établir la relation avec les consultations
    public function consultations()
    {
        return $this->hasMany(Consultation::class);
    }

    public function prescriptions()
    {
        return $this->hasMany(Prescription::class);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            // Initialisation des informations de santé
            $user->average_heart_rate = 70; // Valeur par défaut
            $user->daily_step_goal = 0;
            $user->sleep_quality = 8;
            $user->last_consultation = now()->toDateString();
        });
    }

    public function goals()
    {
        return $this->hasOne(Goal::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function sleepRecords()
    {
        return $this->hasMany(SleepRecord::class);
    }
}
