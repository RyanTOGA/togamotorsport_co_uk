<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penalty extends Model
{
    use HasFactory;

    protected $fillable = [
        'incident_report_id',
        'time_penalty',
        'penalty_comments',
        'is_penalty',
        'is_warning',
        'is_no_action',
    ];
}
