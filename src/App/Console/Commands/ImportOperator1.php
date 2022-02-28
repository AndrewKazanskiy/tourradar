<?php

namespace App\Console\Commands;

use Domain\Imports\Actions\CreateImport;
use Domain\Imports\DataTransferObjects\CreateImportData;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;

class ImportOperator1 extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import-operator-1';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get operator JSON and transfer to TourData file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CreateImport $action)
    {
        //assuming that we got already JSON file form remote Operator
        $data = collect(json_decode(file_get_contents(public_path()."/operator1.json")));
       // dd($data->first()[0]);

        //1. Checking if current

        $dataToImport = CreateImportData::fromRequest($data->first()[0]);
dd($dataToImport);
        $import = $action->execute($dataToImport);

        return 0;
    }
}
