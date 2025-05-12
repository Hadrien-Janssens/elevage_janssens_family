<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Cats;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CatsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cat::create([
            'name' => 'Urban',
            'body_color' => 'Black Silver mackerel tabby',
            'gender' => 'Mâle',
            'race' => 'British shorthair',
            'birthday' => '2023-04-28',
            'description' => 'Urban, notre British Shorthair Black Silver Mackerel Tabby, est un chat aussi élégant qu’attachant. D’un naturel plutôt peureux et méfiant, il révèle toute sa tendresse une fois la confiance établie. Véritable pot de colle, il adore les câlins et se blottir dans les bras de ceux qu’il aime.',
        ]);
        Cat::create([
            'name' => 'Una',
            'body_color' => 'Blue',
            'gender' => 'Femelle',
            'race' => 'Scottish Fold',
            'birthday' => '2023-04-17',
            'description' => 'Una, notre Scottish Fold Blue, incarne la sérénité à l\'état pur. D’un tempérament incroyablement calme et zen, rien ne semble pouvoir la perturber. Elle adore les caresses et fait tourner sa machine à ronrons à la moindre attention, tout en gardant une part d\'indépendance avec une élégance naturelle.',
        ]);
    }
}
