<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\OfficePermission;
use Illuminate\Support\Facades\Storage;

class CreateOfficePermissions extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:office-permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $disk = Storage::disk('laravel');
        $crudsArray = [];
        foreach ($disk->allFiles('app/Http/Controllers/Admin/') as $file) {
            if (!str_contains($file, 'Traits')){
                $controllerName = str_replace("app/Http/Controllers/Admin/", "", $file);
                $controllerName = str_replace(".php", "", $controllerName);
                $crudsArray[$controllerName] = $controllerName;
            }
        }
        $nameActions = [];
        $nameActions['show'] = 'Mostrar';
        $nameActions['create'] = 'Crear';
        $nameActions['update'] = 'Actualizar';
        $nameActions['delete'] = 'Eliminar';

        foreach ($crudsArray as $crud) {
            $office = OfficePermission::where('crud_controller', $crud)->first();
            if (is_null($office)){
                foreach ($nameActions as $key => $value) {
                    OfficePermission::create(
                        [
                            'crud_controller' =>  $crud,
                            'name' => $key
                        ]
                    );
                }
            }
        }
    }
}
