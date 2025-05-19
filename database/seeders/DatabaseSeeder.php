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
        $i = 0;

        while ($i < 100000) {
            User::factory()->create([
                'name' => fake()->name(),
                'email' => sprintf('%s@%s.com', fake()->lexify, md5(sprintf('%s.%d', fake()->lexify, fake()->numberBetween()))),
            ]);
            $i++;
        }
    }
}
