<?php

namespace App\Models;

use Carbon\Carbon;
use Carbon\CarbonInterval;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property mixed $race_id
 * @property mixed $car_id
 * @property mixed $best_lap
 */
class RaceDrivers extends Model
{
    use HasFactory;

    protected $table = 'race_drivers';
    protected $fillable = [
        'race_id',
        'car_id',
        'race_number',
        'car_number',
        'cup_cat',
        'car_group',
        'team_name',
        'nationality',
        'name',
        'short_name',
        'player_id',
        'best_lap',
        'total_time',
        'lap_count',
        'best_lap_splits',
    ];

    public function totalLaps()
    {
        return RaceLaps::query()
            ->where('race_id', $this->race_id)
            ->where('car_id', $this->car_id)
            ->count();
    }

    public function validLaps()
    {
        return RaceLaps::query()
            ->where('race_id', $this->race_id)
            ->where('car_id', $this->car_id)
            ->where('is_valid_for_best', 1)
            ->count();
    }

    public function notValidLaps()
    {
        return RaceLaps::query()
            ->where('race_id', $this->race_id)
            ->where('car_id', $this->car_id)
            ->where('is_valid_for_best', 0)
            ->count();
    }

    public function bestLap()
    {
        $is_negative = false;
        $force_hours = false;
        if ($this->total_time < 0)
        {
            // Make positive for further formatting
            $is_negative = true;
            $seconds = abs($this->total_time);
        }


        $round_seconds = (int)$this->total_time;
        $hours = floor($round_seconds / 3600);
        $minutes = floor(($round_seconds - ($hours * 3600)) / 60);
        $secs = floor(($round_seconds - ($hours * 3600) - ($minutes * 60)));
        $secs_micro = round($this->total_time - $round_seconds, 4) + $secs;

        $secs_formatted = str_pad(
            sprintf('%02.4f', $secs_micro), 7, 0, STR_PAD_LEFT);

        // Format
        $format = sprintf('%02d:%s', $minutes, $secs_formatted);

        if ($hours OR $force_hours)
        {
            // Prefix format with hours
            $format = sprintf('%02d:', $hours).$format;
        }

        // Add minus sign if negative
        if ($is_negative) $format = '-'.$format;

        // Return the format
        return $format;


    }
}
