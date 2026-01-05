<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Project;
use App\Models\Page;

class GenerateSitemap extends Command
{
    protected $signature = 'sitemap:generate';
    protected $description = 'Generate the sitemap.xml file';

    public function handle(): void
    {
        $this->info('Generating sitemap...');

        $sitemap = Sitemap::create()
            ->add(Url::create('/'))
            ->add(Url::create('/hakkimizda'))
            ->add(Url::create('/projeler'))
            ->add(Url::create('/iletisim'));

        // Add all active projects
        $projects = Project::active()->get();
        foreach ($projects as $project) {
            $sitemap->add(
                Url::create("/projeler/{$project->slug}")
                    ->setLastModificationDate($project->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.8)
            );
        }

        // Add all published pages
        $pages = Page::where('status', 'published')->get();
        foreach ($pages as $page) {
            $sitemap->add(
                Url::create("/sayfa/{$page->slug}")
                    ->setLastModificationDate($page->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.6)
            );
        }

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully: public/sitemap.xml');
    }
}
