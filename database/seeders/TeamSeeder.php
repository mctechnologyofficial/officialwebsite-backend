<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['name'  => 'Team A'],
            ['name'  => 'Team B'],
            ['name'  => 'Team C'],
            ['name'  => 'Team D'],
        ];

        Team::insert($data); // Eloquent approach
    }
}
