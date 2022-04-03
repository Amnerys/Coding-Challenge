<?php

namespace App\Console\Commands;

use App\Imports\ProductsImport;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Excel;

//To run this command, type 'php artisan sync:product' on the command line
class SyncProduct extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:product';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to sync CSV';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }


    private $localFile = 'Artikel.csv';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Storage::disk($this->localFile);
        ini_set('memory_limit', '-1');
        ini_set('max_execution_time', '300');
        Excel::import(new ProductsImport(), $this->localFile,null,
            \Maatwebsite\Excel\Excel::CSV);

        return Command::SUCCESS;

    }
}
