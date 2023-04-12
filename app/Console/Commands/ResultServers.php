<?php

namespace App\Console\Commands;

use App\Models\RaceDrivers;
use App\Models\RaceLaps;
use App\Models\RaceSession;
use App\Models\Server;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ResultServers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:result-servers';

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
        $servers = Server::all();
        foreach ($servers as $server) {
            $results = Storage::build([
                'driver' => $server->driver,
                'host' => $server->ip_address,
                'username' => ($server->driver == 'ftp') ? env('FTP_USERNAME') : env('SFTP_USERNAME'),
                'password' => ($server->driver == 'ftp') ? env('FTP_PASSWORD') : env('SFTP_PASSWORD'),
                'port' => $server->port,
                'root' => $server->root,
            ])->allFiles('results');
            foreach ($results as $result) {
                if (Str::contains($result, ['FP', 'Q', 'R'])) {
                    $file = Storage::build([
                        'driver' => $server->driver,
                        'host' => $server->ip_address,
                        'username' => ($server->driver == 'ftp') ? env('FTP_USERNAME') : env('SFTP_USERNAME'),
                        'password' => ($server->driver == 'ftp') ? env('FTP_PASSWORD') : env('SFTP_PASSWORD'),
                        'port' => $server->port,
                        'root' => $server->root,
                    ])->get($result);
                    $response = str_replace(chr(0), '', $file);
                    $contents = utf8_encode($response);
                    $raceData = json_decode($contents);

                    $raceSession = RaceSession::query()->updateOrCreate([
                        'session_type' => $raceData->sessionType ?? NULL,
                        'track_name' => $raceData->trackName ?? NULL,
                        'server_name' => $raceData->serverName ?? NULL,
                        'best_lap' => (isset($raceData->sessionResult)) ? $raceData->sessionResult->bestlap : NULL,
                        'best_splits' => (isset($raceData->sessionResult)) ? implode(',', $raceData->sessionResult->bestSplits) : NULL,
                        'is_wet' => (isset($raceData->sessionResult)) ? $raceData->sessionResult->isWetSession : 0,
                        'server_ip' => $server['ip_address']
                    ]);

                    if (isset($raceData->sessionResult)) {
                        $leaderBoards = $raceData->sessionResult->leaderBoardLines;
                        foreach ($leaderBoards as $board) {
                            $car = $board->car;
                            $driver = $board->currentDriver;
                            $timing = $board->timing;

                            RaceDrivers::query()->updateOrCreate([
                                'race_id' => $raceSession->id,
                                'car_id' => $car->carId,
                                'race_number' => $car->raceNumber,
                                'car_number' => $car->carModel,
                                'cup_cat' => $car->cupCategory,
                                'car_group' => $car->carGroup,
                                'team_name' => $car->teamName,
                                'nationality' => $car->nationality,
                                'name' => $driver->firstName . ' ' . $driver->lastName,
                                'short_name' => $driver->shortName,
                                'player_id' => $driver->playerId,
                                'best_lap' => $timing->bestLap,
                                'total_time' => $timing->totalTime,
                                'lap_count' => $timing->lapCount,
                                'best_lap_splits' => implode(',', $timing->bestSplits),
                            ]);
                        }

                        $laps = $raceData->laps;
                        foreach ($laps as $lap) {
                            RaceLaps::query()->updateOrCreate([
                                'race_id' => $raceSession->id,
                                'car_id' => $lap->carId,
                                'driver_index' => $lap->driverIndex,
                                'lap_time' => $lap->laptime,
                                'is_valid_for_best' => $lap->isValidForBest,
                                'splits' => implode(',', $lap->splits),
                            ]);
                        }
                    }
                }
            }
        }
    }
}
