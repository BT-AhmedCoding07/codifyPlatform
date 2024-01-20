<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "prenom" => "admin",
            "nom"  => "admin",
            "email" => "admin@gmail.com",
            "password" => Hash::make('Admin123@'),
            "roles_id" => 1,
            "telephone" => 770000000
        ]);
    }
}
