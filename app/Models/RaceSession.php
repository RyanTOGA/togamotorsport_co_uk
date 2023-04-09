<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class RaceSession extends Model
{
    use HasFactory;

    protected $table = 'race_sessions';
    protected $fillable = ['session_type','track_name','server_name','is_wet','best_lap','best_splits','server_ip'];
}
