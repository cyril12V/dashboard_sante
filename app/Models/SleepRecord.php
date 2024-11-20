<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SleepRecord extends Model
{
    protected $fillable = ['user_id', 'date', 'hours_slept'];

}
