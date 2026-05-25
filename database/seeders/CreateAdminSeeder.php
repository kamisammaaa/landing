<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CreateAdminSeeder extends Seeder
{
    public function run(): void
    {
        if (!User::where('email', 'admin@smkba.sch.id')->exists()) {
            User::create([
                'name' => 'KAMI',
                'email' => 'kamisammaaa@gmail.com',
                'password' => Hash::make('Ganteng8'), // Ganti password!
                'email_verified_at' => now(),
            ]);
            $this->command->info('✅ Admin user created!');
        } else {
            $this->command->info('ℹ️ Admin user already exists.');
        }
    }
}
