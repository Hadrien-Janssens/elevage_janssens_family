<?php

namespace Database\Seeders;

use App\Models\Kitten;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KittenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Kitten::create([
            'name' => 'Sya',
            'body_color' => 'Brown Mackerel Tabby',
            'gender' => 'Femelle',
            'race' => 'British shorthair',
            'litter_id' => 1,
            'description' => 'Sya est une véritable aventurière dans l’âme. Intrépide et curieuse, rien ne lui fait peur ! Toujours en exploration, elle s’adapte à tout avec une aisance naturelle. Très sociable, elle aime notre compagnie et ne manque jamais une occasion de venir partager un moment avec nous.',
            'price' => 900,
        ]);
        Kitten::create([
            'name' => 'Bandit',
            'body_color' => 'Ecaille de tortue',
            'gender' => 'Femelle',
            'race' => 'British shorthair',
            'litter_id' => 1,
            'description' => 'Bandit porte bien son nom : c’est une petite féline au caractère bien trempé et à l’énergie débordante. Franche, curieuse et aventureuse, elle adore explorer, jouer et se lancer dans des batailles endiablées avec ses frères et sœurs. Une vraie petite cheffe de bande pleine de vie !',
            'price' => 900,
        ]);

        Kitten::create([
            'name' => 'Muffin',
            'body_color' => 'Black silver blocked tabby',
            'gender' => 'Mâle',
            'race' => 'British Longhair',
            'litter_id' => 1,
            'description' => 'Muffin porte à merveille son nom : c’est un adorable petit patapouf au cœur tendre. Son activité préférée ? Manger, puis faire une bonne sieste bien méritée. Calme et gourmand, il incarne la douceur et le confort à l’état pur.',
            'price' => 900,
        ]);

        Kitten::create([
            'name' => 'Sushi',
            'body_color' => 'Cream mackerel tabby',
            'gender' => 'Mâle',
            'race' => 'British Longhair',
            'litter_id' => 1,
            'description' => 'Sushi, c’est le parfait mélange entre tendresse et espièglerie. Adorable petit chaton câlin et véritable machine à ronron, il sait se faire aimer… tout en gardant un petit côté farceur. Sa passion ? Embêter ses frères et sœurs, toujours avec malice et affection.',
            'price' => 900,
        ]);

        Kitten::create([
            'name' => 'Snow',
            'body_color' => 'Brown Mackerel Tabby',
            'gender' => 'Mâle',
            'race' => 'British shorthair',
            'litter_id' => 1,
            'description' => 'Snow, notre petit chaton au tempérament doux et discret, est une boule de tendresse tout en délicatesse. Un peu timide et peu téméraire, il préfère l’observation à l’aventure. Calme et posé, il apprécie les caresses en toute simplicité, sans jamais en demander trop.',
            'price' => 900,
        ]);
        Kitten::create([
            'name' => 'Garfield',
            'body_color' => 'Blue',
            'gender' => 'Mâle',
            'race' => 'Scottish straight',
            'litter_id' => 2,
            'description' => 'Garfield est un véritable petit pot de colle au grand cœur. Toujours en quête de proximité, il n’hésite pas à grimper sur nous pour réclamer de l’attention et partager un moment de tendresse. Attachant et affectueux, il ne passe jamais inaperçu..',
            'price' => 900,
        ]);
        Kitten::create([
            'name' => 'Bouh',
            'body_color' => 'Black silver mackerel tabby',
            'gender' => 'Femelle',
            'race' => 'Scottish straight',
            'litter_id' => 2,
            'description' => 'Bouh est une petite boule d’énergie pleine de tendresse. Câline, curieuse et très joueuse, elle aime autant les moments de complicité que les sessions de jeu. Toujours partante pour une exploration ou un câlin, elle apporte de la joie partout où elle passe..',
            'price' => 900,
        ]);
        Kitten::create([
            'name' => 'Vagabond',
            'body_color' => 'Black silver ticked tabby',
            'gender' => 'Mâle',
            'race' => 'Scottish fold',
            'litter_id' => 2,
            'description' => 'Vagabond est un chaton calme et réservé, au regard doux et discret. Un peu craintif au premier abord, il observe son monde avec prudence. Mais derrière sa timidité se cache une grande sensibilité, qu’il révèle petit à petit, à son rythme..',
            'price' => 1000,
        ]);
        Kitten::create([
            'name' => 'Vasco',
            'body_color' => 'Black silver ticked tabby',
            'gender' => 'Mâle',
            'race' => 'Scottish straight',
            'litter_id' => 2,
            'description' => 'Vasco est un petit chaton curieux et sociable qui adore notre compagnie. Toujours prêt à explorer son environnement, il n’hésite jamais à venir voir ce que l’on fait, avec une touche de malice et beaucoup d’affection..',
            'price' => 900,
        ]);
    }
}
