<?php

namespace Database\Seeders;

use App\Models\Resto;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('app.debug', false)) {
            Resto::factory()->count(100)->create();
        }
    }
}
