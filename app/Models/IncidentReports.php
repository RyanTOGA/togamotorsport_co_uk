<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncidentReports extends Model
{
    use HasFactory;

    protected $fillable = [
        'session_id',
        'track_name',
        'turn_number',
        'your_race_number',
        'offending_car_race_number',
        'video_link',
        'comments'
    ];

    protected function trackName(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => strtoupper($value),
        );
    }

    public function session()
    {
        return $this->hasOne(RaceSession::class,'id','session_id');
    }

    public function penalty()
    {
        return $this->hasOne(Penalty::class,'id','incident_report_id');
    }

    public function raisedBy()
    {
        return RaceDrivers::query()->where('race_id',$this->session_id)->where('race_number', $this->your_race_number)->first();
    }

    public function offendingDriver()
    {
        return RaceDrivers::query()->where('race_id',$this->session_id)->where('race_number', $this->offending_car_race_number)->first();
    }
}
