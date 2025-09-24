<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Seeder bawaan (kalau mau pakai user dummy)
        // \App\Models\User::factory(10)->create();

        // Buat 1 user test (opsional)
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Tambahkan seeder kategori
        $this->call([
            CategoriesTableSeeder::class,
        ]);
    }
}
