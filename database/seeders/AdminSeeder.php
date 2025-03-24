<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "name" => "Admin",
            "lastname" => "Admin",
            "adresse" => "Admin",
            "phone" => "2250708377751",
            "role" => "admin",
            "email" => "pataime56@gmail.com",
            "password" => Hash::make("123456@p"),
            "status" => 1,
            "created_by" => "Admin"
        ];

        \App\Models\Admin::create($data);
    }
}
