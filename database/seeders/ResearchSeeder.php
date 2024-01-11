<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchSeeder extends Seeder
{
    public function run()
    {
        DB::table('researches')->insert([
            ['name' => 'Research Topic 1'],
            ['name' => 'Research Topic 2'],
            ['name' => 'Research Topic 3'],
            ['name' => 'Research Topic 4'],
            ['name' => 'Research Topic 5'],
        ]);
    }
}
