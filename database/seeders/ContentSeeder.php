<?php

namespace Database\Seeders;

use App\Models\Content;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Content::create([
            'title' => 'Qui sommes-nous ?',
            'content' => 'Nous sommes un élevage familial où passion, dévouement et amour des félins font partie intégrante de nos valeurs. Un foyer chaleureux où les chats grandissent heureux et équilibrés, prêts à devenir le compagnon idéal pour votre famille. Avec un attachement particulier pour les Scottish et les British, c’est tout naturellement que nous nous sommes tourné vers cette race pour notre élevage'
        ]);
        Content::create([
            'title' => 'A propos avant la photographie',
            'content' => 'Bienvenue chez nous, Laura et Hadrien, un jeune couple passionné de chats, situé au cœur du Hainaut, à Morlanwelz. Nous avons respectivement 28 et 30 ans et partageons notre amour pour les félins depuis de nombreuses années.'
        ]);

        Content::create([
            'title' => 'A propos après la photographie',
            'content' => "Mariés depuis 6 ans, les chats font partie intégrante de notre vie. Nous avons toujours été entourés de ces adorables compagnons à quatre pattes, considérés comme des membres à part entière de notre famille. En 2023, nous avons décidé d'agrandir notre tribu en accueillant Una et Urban, une scottish fold et un british shorthair qui ont rapidement trouvé leur place parmi nous.
            Pour nous, l'élevage est une véritable passion que nous chérissons chaque jour. Nous chats sont élevés au sein d'un foyer familial, ce qui les rend plus sociables et amitieux. Avec notre fille, âgée de 3 ans, ils ont également l’habitude de vivre en présence d'enfants, et nous avons constaté que nos chats s'épanouissent également en sa compagnie.
            Si vous recherchez un compagnon félin aimant et bien élevé, nous sommes là pour vous guider et vous aider à trouver le compagnon idéal qui correspondra à vos besoins et à votre style de vie.
            N'hésitez pas à nous contacter pour découvrir notre élevage familial, où passion, dévouement et amour des chats sont les maîtres-mots."
        ]);

        Content::create([
            'title' => "Signature",
            'content' => "Janssens Family"
        ]);

        Content::create([
            'title' => "Conditions d'adoptions",
            'content' => "Tous nos chatons sont disponibles à partir de 12 semaines.  Ils sont vendus pucés, vaccinés, vermifugés, traités contre les puces/parasites et munis de leur passeport européen au prix de 900€. Le chaton partira également avec un petit kit de départ offert qui comprend : croquette, friandise et jeu. Nos chatons sont élevés dans l’amour et la bienveillance. C’est pour cette raison que nous nous réservons le droit de lui choisir la meilleur des familles et nous nous réservons le droit de refuser une adoption si celle-ci ne convient pas. "
        ]);

        Content::create([
            'title' => "Réservation",
            'content' => "Vous avez craqué pour un de nos chatons ?
            Pas de panique, vous pouvez le réserver à partir de ses 6 semaines.
            Comment faire ?Vous prenez contact avec nous afin de vérifier la disponibilité du chaton et nous planifions ensuite une visite si vous souhaitez le voir. La réservation est validée après le paiement d’un acompte de 100 euros."
        ]);

        Content::create([
            'title' => "Conseils",
            'content' => "Afin que votre nouveau petit protégé ait le temps de s’adapter à vous lors de son arrivée, nous vous conseillons de venir le chercher le plus tôt possible dans la journée. Cela lui évitera de se retrouver immédiatement tout seul pendant la nuit. Il aura ainsi le temps de s’habituer à son nouvel environnement mais aussi à sa nouvelle famille."
        ]);
    }
}
