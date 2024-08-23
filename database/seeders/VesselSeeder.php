<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Vessels;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VesselSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Vessels::insert(
            [
                [
                    'name' => 'M.V SATIGNY',
                    'flag' => 'Singapore',
                    'type' => 'Tanker',
                    'IMO_number' => '9875604',
                    'built' => '2001',
                    'GRT' => '36106',
                    'DWT' => '63574',
                    'Engine' => 'Cummins',
                    'BHP' => '8532',
                    'Trade' => 'Worldwide',
                    'created_at' => Carbon::now(),
                    'updated_at'=> Carbon::now()
                ],
                [
                    'name' => 'M.V New Global',
                    'flag' => 'Panama',
                    'type' => 'Bulk Carrier',
                    'IMO_number' => '9975622',
                    'built' => '2003',
                    'GRT' => '46106',
                    'DWT' => '56574',
                    'Engine' => 'Yanmar',
                    'BHP' => '8532',
                    'Trade' => 'Worldwide',
                    'created_at' => Carbon::now(),
                    'updated_at'=> Carbon::now()
                ]
            ]
            );
    }
}
