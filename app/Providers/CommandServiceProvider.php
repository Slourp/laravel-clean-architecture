<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Symfony\Component\Finder\Finder;
use Illuminate\Console\Application;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadInfrastructureCommands();
        $this->loadContextSpecificCommands();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Load commands from the global infrastructure directory.
     */
    protected function loadInfrastructureCommands()
    {
        $directory = base_path('src/Infrastructure/Ports/Console/Commands');
        $namespace = 'Infrastructure\Ports\Console\Commands';
        $this->registerCommandsFromDirectory($directory, $namespace);
    }

    /**
     * Load commands from each context's directory.
     */
    protected function loadContextSpecificCommands()
    {
        $contextBaseDirectory = base_path('src/Domain');
        $contexts = $this->getContexts($contextBaseDirectory);

        foreach ($contexts as $context) {
            $directory = $contextBaseDirectory . '/' . $context . '/Infrastructure/Ports/Console/Commands';
            $namespace = "Domain\\{$context}\Infrastructure\Ports\Console\Commands";
            $this->registerCommandsFromDirectory($directory, $namespace);
        }
    }

    /**
     * Get the list of contexts from the base directory.
     *
     * @param  string $directory
     * @return array
     */
    protected function getContexts(string $directory): array
    {
        $contexts = [];
        foreach (new \DirectoryIterator($directory) as $folder) {
            if ($folder->isDir() && !$folder->isDot()) {
                $contexts[] = $folder->getFilename();
            }
        }

        return $contexts;
    }

    /**
     * Register commands from a given directory with a specified namespace.
     *
     * @param  string $directory
     * @param  string $namespace
     */
    protected function registerCommandsFromDirectory(string $directory, string $namespace)
    {
        if (!is_dir($directory)) return;

        foreach ((new Finder)->in($directory)->files() as $file) {
            $command = $namespace . '\\' . $file->getFilenameWithoutExtension();
            Application::starting(function ($artisan) use ($command) {
                $artisan->resolve($command);
            });
        }
    }
}
