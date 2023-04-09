<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RaceLaps extends Model
{
    use HasFactory;

    protected $table = 'race_laps';
    protected $fillable = [
      'race_id',
      'car_id',
      'driver_index',
      'lap_time',
      'is_valid_for_best',
      'splits',
    ];
}
