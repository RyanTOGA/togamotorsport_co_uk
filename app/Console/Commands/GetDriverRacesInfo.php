<?php

namespace App\Console\Commands;

use App\Models\RaceDrivers;
use Illuminate\Console\Command;

class GetDriverRacesInfo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:get-driver-races-info {steam_id}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $steam_id = $this->argument('steam_id');
        $total_laps = 0;
        $valid_laps = 0;
        $not_valid_laps = 0;
        $driverRaces = RaceDrivers::query()->where('player_id', $steam_id)->get();
        foreach ($driverRaces as $driverRace) {
            dump($driverRace->bestLap());
            $total_laps += $driverRace->totalLaps();
            $valid_laps += $driverRace->validLaps();
            $not_valid_laps += $driverRace->notValidLaps();

        }

        //$percentageValid = (($total_laps - $valid_laps) / $total_laps) * 100;
       // $percentageNotValid = (($total_laps - $not_valid_laps) / $total_laps) * 100;
        $percentageValid = abs(($total_laps - $valid_laps) / $total_laps) * 100;
        $percentageNotValid = abs(($total_laps - $not_valid_laps) / $total_laps) * 100;

        dd($total_laps, $valid_laps, number_format($percentageValid,1), number_format($percentageNotValid,1));

    }
}
