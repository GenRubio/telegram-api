<?php

namespace App\Console\Commands;

use App\Models\ProductModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

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
            DB::update('update product_models set reference = ' . $reference .' where id = ?', [$product->id]);
            $reference = $reference + 1;
        }
    }
}
