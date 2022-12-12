<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Str;

class MakeUseCase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:usecase {useCaseName} {--m|model=}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new UseCase class';

    /**
     * Folder where the Service will be stored
     *
     * @var string
     */
    private $folder;

    /**
     * Folder UNIX permission
     *
     * @var int
     */
    private $folderPermissions = 0755;

    /**
     * Name of the variable
     *
     * @var
     */
    private $singularVariableName;

    /**
     * Name of the UseCase
     *
     * @var
     */
    private $useCaseName;

    /**
     * Model base Namespace
     *
     * @var string
     */
    private $modelNamespaceBase = 'App\Models\\';

    /**
     * UseCases base Namespace
     *
     * @var string
     */
    private $useCasesNamespaceBase = 'App\UseCases';

    /**
     * Name of the model
     *
     * @var
     */
    private $singularModelName;

    public function handle()
    {
        $modelParam = $this->option('model');
        $this->singularModelName = Str::studly($modelParam);

        $this->folder = app_path('UseCases');
        if (!is_null($modelParam) && $this->checkIfModelExists($this->singularModelName)) {
            $this->useCasesNamespaceBase .= '\\' . $modelParam;
            $this->folder .= '/' . $modelParam;
        }

        $this->singularVariableName = Str::lower($this->argument('useCaseName'));
        $this->useCaseName = Str::studly($this->argument('useCaseName') . 'UseCase');

        $this->makeUseCase();
    }

    private function makeUseCase()
    {
        $useCase = $this->replaceWords(file_get_contents('stubs/useCase.stub'));
        $this->saveUseCase($useCase);
    }

    private function saveUseCase(string $file)
    {
        $this->checkIfUseCasesFolderExists();
        if (!is_file($this->folder . '/' . $this->useCaseName . '.php')) {
            file_put_contents($this->folder . '/' . $this->useCaseName . '.php', $file);
            $this->info($this->useCaseName . ' created successfully!');
        } else {
            $this->error('UseCase already exists');
        }
    }

    /**
     * Method that checks if the Service folder exists, and creates it if it does not
     */
    private function checkIfUseCasesFolderExists(): void
    {
        if (!file_exists($this->folder)) {
            mkdir($this->folder, $this->folderPermissions, true);
            $this->info('UseCases folder created successfully!');
        }
    }

    /**
     * Method that checks if the Model exists in the project, if it does not exists, throws an error
     *
     * @param string $model
     */
    private function checkIfModelExists(string $model): bool
    {
        if (!class_exists($this->modelNamespaceBase . $model)) {
            $this->error('The model ' . $model . ' was not found in this project.');
            return false;
        }
        return true;
    }

    private function replaceWords(string $file): string
    {
        $search = [
            'Namespace',
            'SingularUseCaseName',
            'SingularVariableName'
        ];
        $replace = [
            $this->useCasesNamespaceBase,
            $this->useCaseName,
            $this->singularVariableName
        ];
        return str_replace($search, $replace, $file);
    }
}
