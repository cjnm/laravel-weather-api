<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'demouser@email.com')->first();

        if (!$user instanceof User) {
            $user = User::create([
                'name'              => 'Demo User',
                'email'             => 'demouser@email.com',
                'password'          => bcrypt('Password1'),
                'email_verified_at' => now(),
            ]);
        }
        
    }
}
