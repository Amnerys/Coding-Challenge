<?php

namespace App\Console\Commands;

use App\Exports\ProductsExport;
use Illuminate\Console\Command;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Facades\Excel;

//To run this command, type 'php artisan export:csv' on the command line
class StoreProduct extends Command
{
    use Exportable;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'export:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command is for exporting DB data into a CSV file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        Excel::store(new ProductsExport(),'product-collection.csv', null, \Maatwebsite\Excel\Excel::CSV);
        return Command::SUCCESS;
    }

}
