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
            'description' => 'Urban : Le timide au cœur tendre, un amoureux de la compagnie

Urban est un magnifique British Shorthair Black Silver Mackerel Tabby. Son pelage aux motifs tabby argentés et noirs est absolument captivant. Derrière son regard parfois méfiant se cache une âme incroyablement douce et affectueuse. Naturellement peureux, Urban a besoin de temps pour accorder sa confiance, mais une fois ce lien créé, il se révèle être un véritable amour. Il déteste la solitude et s\'épanouit pleinement en étant entouré de sa famille humaine et des autres chats de la maison. C\'est un véritable "pot de colle" qui apprécie énormément les câlins et se blottir tendrement dans les bras..',
        ]);
        Cat::create([
            'name' => 'Una',
            'body_color' => 'Blue',
            'gender' => 'Femelle',
            'race' => 'Scottish Fold',
            'birthday' => '2023-04-17',
            'description' => 'Una : La sérénité incarnée

Una est une magnifique Scottish Fold bleue. Son pelage d\'une douce couleur unie et ses adorables oreilles repliées lui confèrent un charme irrésistible. Son tempérament est à l\'image de sa beauté : d\'une nature très calme et sereine, Una aborde la vie avec une zénitude contagieuse. C\'est une chatte peu stressée, pour qui la vie est définitivement "cool". Elle apprécie grandement les caresses, se transformant rapidement en une véritable machine à ronrons. Cependant, Una sait aussi apprécier son indépendance et savourer de paisibles moments en solo. Elle est le parfait équilibre entre une présence douce et un esprit libre..',
        ]);
    }
}
