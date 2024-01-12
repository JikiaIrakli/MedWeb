<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResearchSeeder extends Seeder
{
    public function run()
    {
        
        DB::table('researches')->insert([
            ['name' => 'კოლკოსკოპია'],
            ['name' => 'ეხოსკოპია'],
            ['name' => 'სისხლის ანალიზი'],
        ]);
    }
}
