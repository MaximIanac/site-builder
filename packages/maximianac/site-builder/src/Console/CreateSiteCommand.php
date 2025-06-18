<?php

namespace Maximianac\SiteBuilder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Str;
use Maximianac\SiteBuilder\Models\Site;
use Maximianac\SiteBuilder\Utility\Enums\SiteType;

class CreateSiteCommand extends Command
{
    protected $signature = 'make:site
                            {title : Название сайта}
                            {--type=landing : Тип сайта (landing, blog, etc.)}
                            {--template=default : Шаблон сайта}
                            {--slug= : ЧПУ (автогенерация, если не указан)}
                            {--langs= : Поддерживаемые языки через запятую (например, en,ru)}';


    protected $description = 'Создает новый сайт с выбранным типом и шаблоном';

    public function handle(): void
    {
        $type = $this->option('type');
        $langs = explode(',', $this->option('langs') ?? 'en');

        $site = Site::create([
            'type' => $type,
            'supported_langs' => $langs
        ]);

        match ($type) {
            SiteType::LANDING => $this->createLandingPages($site),
        };

        $this->info("Сайт типа '$type' создан!");
    }

    private function createLandingPages(Site $site): void
    {
        $template = $this->option('template');

        if (!$this->templateExists($site->type, $template)) {
            $this->error("Шаблон '{$template}' не найден!");
            return;
        }

        $site->pages()->create([
            'title' => 'Home',
            'slug' => $this->option('slug') ?? Str::slug(
                    $this->argument('title')
                ),
            'template' => $template
        ]);
    }

    /**
     * Проверяет, существует ли шаблон.
     */
    protected function templateExists(SiteType $type, string $template): bool
    {
        return view()->exists("site-builder::templates.{$type->value}.{$template}");
    }
}
