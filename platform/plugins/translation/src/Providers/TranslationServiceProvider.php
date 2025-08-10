<?php

namespace Botble\Translation\Providers;

use Botble\Base\Facades\PanelSectionManager;
use Botble\Base\Supports\ServiceProvider;
use Botble\Base\Traits\LoadAndPublishDataTrait;
use Botble\Translation\Console\CleanCommand;
use Botble\Translation\Console\DownloadLocaleCommand;
use Botble\Translation\Console\ExportCommand;
use Botble\Translation\Console\ImportCommand;
use Botble\Translation\Console\RemoveLocaleCommand;
use Botble\Translation\Console\RemoveUnusedTranslationsCommand;
use Botble\Translation\Console\ResetCommand;
use Botble\Translation\Console\UpdateThemeTranslationCommand;
use Botble\Translation\Manager;
use Botble\Translation\Models\Translation;
use Botble\Translation\PanelSections\LocalizationPanelSection;
use Botble\Translation\Repositories\Eloquent\TranslationRepository;
use Botble\Translation\Repositories\Interfaces\TranslationInterface;

class TranslationServiceProvider extends ServiceProvider
{
    use LoadAndPublishDataTrait;

    public function register(): void
    {
        $this->app->bind(TranslationInterface::class, function () {
            return new TranslationRepository(new Translation());
        });

        $this->app->bind('translation-manager', Manager::class);

        $this->commands([
            ImportCommand::class,
        ]);

        if ($this->app->runningInConsole()) {
            $this->commands([
                ResetCommand::class,
                ExportCommand::class,
                CleanCommand::class,
                UpdateThemeTranslationCommand::class,
                RemoveUnusedTranslationsCommand::class,
                DownloadLocaleCommand::class,
                RemoveLocaleCommand::class,
            ]);
        }
    }

    public function boot(): void
    {
        $this->setNamespace('plugins/translation')
            ->loadAndPublishConfigurations(['general', 'permissions'])
            ->loadMigrations()
            ->loadRoutes()
            ->loadAndPublishViews()
            ->loadAndPublishTranslations()
            ->publishAssets();

        PanelSectionManager::default()
            ->register(LocalizationPanelSection::class);
    }
}
