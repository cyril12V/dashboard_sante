<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiagnosticsHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'disease_name',
        'symptoms',
        'diagnosed_at',
    ];
}
