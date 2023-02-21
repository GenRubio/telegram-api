<?php

namespace App\Console\Commands;

use App\Models\ProductModel;
use Illuminate\Console\Command;

class TestLogic extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:logic {id} {reference}';

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

        $productModel = ProductModel::where('id', $this->argument('id'))->first();
        if ($productModel) {
            echo ("Producto encontrado");
            $productModel->update([
                'reference' => $this->argument('reference')
            ]);
            echo ("Referencia actualziada");
        } else {
            echo ("Producto no encontrado");
        }
    }
}
