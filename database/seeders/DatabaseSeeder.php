<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\Family::factory(10)->create();

        // \App\Models\Family::factory()->create();
        // 'name' => 'Test User',
        // 'email' => 'test@example.com',
        // ]);

        $this->call([
            FamilySeeder::class,
        ]);
    }
}