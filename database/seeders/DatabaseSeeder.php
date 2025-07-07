<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate([
            'email' => 'admin@ehb.be',
        ], [
            'name' => 'Admin',
            'username' => 'admin',
            'password' => Hash::make('Password!321'),
            'role' => 'admin',
        ]);
    }
}
