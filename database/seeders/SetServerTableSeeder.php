<?php

namespace Database\Seeders;

use App\Models\Server;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetServerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        Server::query()->create([
//            'driver' => 'ftp',
//            'ip_address' => 'ftp.circuitcore.net',
//            'port' => 52370,
//            'root' => '/',
//        ]);

        Server::query()->create([
            'driver' => 'sftp',
            'ip_address' => '54.36.108.42',
            'port' => 22,
            'root' => '54.36.108.42_10262',
        ]);

        Server::query()->create([
            'driver' => 'sftp',
            'ip_address' => '51.195.89.93',
            'port' => 8822,
            'root' => '51.195.89.93_9800',
        ]);

        Server::query()->create([
            'driver' => 'sftp',
            'ip_address' => '54.36.111.191',
            'port' => 8822,
            'root' => '54.36.111.191_9800',
        ]);

        Server::query()->create([
            'driver' => 'sftp',
            'ip_address' => '141.95.72.107',
            'port' => 8822,
            'root' => '141.95.72.107_9800',
        ]);
    }
}
