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
        // User::factory(10)->create();

        // Diubah menggunakan NIM agar sinkron dengan perubahan model User sebelumnya
      User::factory()->create([
            'name' => 'Test User',
            'nim' => '3312501066', // Gunakan NIM contoh milikmu
            'password' => bcrypt('password'), // atau Hash::make()
            // HAPUS BARIS 'email' => 'test@example.com' dari sini!
]);

        // Panggil seeder untuk data master UKM dan pengaturan role
        $this->call([
            UkmSeeder::class,          // Tambahan seeder baru kita
            RoleSettingsSeeder::class,  // Bawaan proyekmu sebelumnya
        ]);
    }
}
