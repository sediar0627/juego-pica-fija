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

        User::factory()->create([
            'name' => 'Sebastian Diaz',
            'email' => 'sebastian@correo.com',
            'password' => bcrypt('123456789'),
        ]);

        User::factory()->create([   
            'name' => 'Deyalik Delannoy',
            'email' => 'deyalik@correo.com',
            'password' => bcrypt('123456789'),
        ]);
    }
}
