<?php

namespace Database\Seeders;

use App\Models\Litter;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LitterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Litter::create([
            'name' => 'Pipoux',
            'birth_date' => '2023-02-17',
            'mother_id' => '2',
            'father_id' => '1',
            'description' => 'Cette magnifique portée, née de l\'union entre Una (notre Scottish Fold blue d\'un calme absolu) et Urban (le British Shorthair black silver tabby timide mais ultra-câlin), réunit cinq petits caractères uniques : De l\'intrépide Bandit à l\'aventurière Sya, en passant par le câlin Sushi, le discret Snow et le gourmet Muffin, ils forment un adorable panel de personnalités où chaque chaton révèle une facette différente de l\'héritage exceptionnel de leurs parents.
            Une portée où tendresse, malice et sérénité se côtoient avec harmonie !',
        ]);
        Litter::create([
            'name' => 'Oursons',
            'birth_date' => '2022-07-05',
            'mother_id' => '2',
            'father_id' => '1',
            'description' => 'Nés de l’union d’Una, Scottish Fold blue au tempérament zen, et d’Urban, British Shorthair black silver mackerel tabby au cœur tendre, cette portée réunit quatre chatons adorables et pleins de charme : Vagabond, Vasco, Bouh et Garfield. Entre douceur, curiosité, jeu et câlins, chacun d’eux exprime une facette unique de cette belle combinaison de caractères.',
        ]);
        Litter::create([
            'name' => 'Lardons',
            'birth_date' => '2021-07-21',
            'mother_id' => '2',
            'father_id' => '1',
            'description' => 'Litter of 6 puppies',

        ]);
    }
}
