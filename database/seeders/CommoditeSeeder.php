<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CommoditeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $commodites = [
            ['libelle' => 'Wi-Fi gratuit', 'icon' => 'icon_wifi', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Climatisation', 'icon' => 'icon_air_conditioning', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Parking sécurisé', 'icon' => 'icon_parking', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Espace VIP', 'icon' => 'icon_vip', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Terrasse', 'icon' => 'icon_terrace', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Piscine', 'icon' => 'icon_pool', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Salle de jeux', 'icon' => 'icon_game_room', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Spectacles en live', 'icon' => 'icon_live_music', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Service de livraison', 'icon' => 'icon_delivery', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Espace fumeur', 'icon' => 'icon_smoking_area', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Privatisation possible', 'icon' => 'icon_private_event', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Accessibilité PMR', 'icon' => 'icon_accessible', 'status' => 1, 'created_by' => 'admin'],
            ['libelle' => 'Sécurité 24h/24', 'icon' => 'icon_security', 'status' => 1, 'created_by' => 'admin'],
        ];

        foreach ($commodites as $commodite) {
            \App\Models\Commodite::create($commodite);
        }
    }
}
