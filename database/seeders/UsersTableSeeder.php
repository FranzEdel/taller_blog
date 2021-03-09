<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Franz Edel',
            'email' => 'franz@mail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('franzedel'),
            'remember_token' => Str::random(10),
        ]);
        
        User::factory()->count(29)->create();

        
    }
}
