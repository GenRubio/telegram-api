<?php

namespace App\Console\Commands;

use App\Models\ProductModelsFlavor;
use Illuminate\Console\Command;

class UpdateReferenceFlavor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:reference-flavor {id}';

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
        $id = $this->argument('id');
        $flavor = ProductModelsFlavor::find($id);
        $flavor->reference = null;
        $flavor->save();
    }
}
