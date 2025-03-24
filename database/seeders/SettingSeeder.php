<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            "name" => "Les bons plans",
            "email" => "lesbonsplan@consulting.com",
            "phone" => "0225070837751",
            "lien" => "/assets/logo.png",
            "logo_black" => "/assets/logo.png",
            "favicon" => "/assets/logo.png",
            "auteur" => "Patrick Aimé",
            "created_by" => "Admin",
        ];

        \App\Models\Setting::create($data);
    }
}
