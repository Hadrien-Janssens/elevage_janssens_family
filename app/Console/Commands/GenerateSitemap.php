<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Kitten; // adapte ce modèle si besoin

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Génère automatiquement le sitemap.xml';

    public function handle(): int
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/a-propos'))
            ->add(Url::create('/mentions-legales'));

        foreach (Kitten::all() as $chaton) {
            $sitemap->add(
                Url::create("/chatons/{$chaton->id}")
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap généré avec succès.');
        return Command::SUCCESS;
    }
}
