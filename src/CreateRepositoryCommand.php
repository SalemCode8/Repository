<?php

namespace Salemcode8\Repository;

use File;
use Illuminate\Console\Command;
use Illuminate\Contracts\Filesystem\FileNotFoundException;

class CreateRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {repository} {--m|model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create New Repository';

    /**
     * Execute the console command.
     *
     * @return mixed
     * @throws FileNotFoundException
     */
    public function handle()
    {
        $repository = $this->argument('repository');
        $model = $this->option('model');
        $name = str_replace('repository', '', strtolower($repository));
        if(!File::exists(app_path('Repositories'))){
            File::makeDirectory(app_path('Repositories'));
        }
        $repo = $repository . (strpos($repository, 'Repository') ? '' : 'Repository');
        $content = File::get(__DIR__ . '/RepoStub.stub');
        $contents = preg_replace('/{model}/', ucfirst($name), $content);
        File::put(app_path("Repositories/{$repo}.php"), $contents);
    }
}
