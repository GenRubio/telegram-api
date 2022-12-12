<?php

namespace App\Console\Commands;

class MakePrepare extends MakeFileStructure
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:prepare {path}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new Prepare class';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();

        $this->setNameSpace('App/Prepares');
        $this->setSuffix('Prepare');
        $this->setStubPath('stubs/task.stub');
        $this->setExtension('.php');
        $this->setFolderPermissions(0755);
    }

    /**
     * Method that change the keywords in the stub files, for the ones given
     *
     * For $this->setMultiFiles() use
     * replaceWords_0
     * replaceWords_1
     * replaceWords_2
     *
     * @param string $file
     * @return string
     */
    public function replaceWords_0(string $file): string
    {
        $search = [
            'NameSpacePathStub',
            'ClassNameStub'
        ];
        $replace = [
            $this->getNamespace(),
            $this->getClassName()
        ];
        return str_replace($search, $replace, $file);
    }
}
