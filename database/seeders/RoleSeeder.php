<?php

namespace Database\Seeders;

use App\Models\Roles;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::insert([
            [
                 'name' => 'Engine Cadet (EC)',
                 'description' => 'assisting senior engineers in the day-to-day operations of the engine room',
                 'created_at' => Carbon::now(),
                 'updated_at'=> Carbon::now()
            ],
            [
                'name' => 'Wiper (WP)',
                'description' => 'maintains working and storage area by wiping down machinery and cleaning oil spill',
                'created_at' => Carbon::now(),
                'updated_at'=> Carbon::now()
            ]
        ]);
    }
}
