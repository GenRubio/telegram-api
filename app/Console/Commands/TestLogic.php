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
    protected $signature = 'test:logic';

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
        $reference = 202210000;
        $products = ProductModel::all();
        foreach($products as $product){
            $product->reference = $reference;
            $product->save();
            $reference = $reference + 1;
        }
    }
}
