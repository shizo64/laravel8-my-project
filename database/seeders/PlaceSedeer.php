<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PlaceSedeer extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Place::factory()->count(20)->create(); // Создаем 20 мест
    }
}
