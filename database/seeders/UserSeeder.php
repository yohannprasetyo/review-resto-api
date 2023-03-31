<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (config('app.debug', false)) {
            User::create(['name' => 'tester', 'email' => 'someone@email.com', 'password' => bcrypt('password')]);
        }
    }
}
