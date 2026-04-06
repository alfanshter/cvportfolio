<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        // Create admin user
        User::factory()->create([
            'name'     => 'Admin',
            'email'    => 'admin@cv.test',
            'password' => bcrypt('password'),
        ]);

        $this->call(CVSeeder::class);
    }
}
