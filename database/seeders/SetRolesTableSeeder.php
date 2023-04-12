<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = ['god', 'admin', 'steward', 'driver'];

        foreach ($roles as $role) {
            Role::query()->create([
                'name' => $role
            ]);
        }
    }
}
