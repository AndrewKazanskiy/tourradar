<?php

namespace App\Console\Commands;

use Domain\App\Models\Operator;
use Domain\Tours\Actions\CreateTour;
use Domain\Tours\Actions\UpdateTour;
use Domain\Tours\DataTransferObjects\CreateTourData;
use Domain\Tours\DataTransferObjects\UpdateTourData;
use Domain\Tours\Models\Tour;
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
    public function handle(CreateTour $action, UpdateTour $updateAction)
    {
        //assuming that we got already JSON file form remote Operator
        $data = collect(json_decode(file_get_contents(public_path()."/operator1.json")));

        if(isset($data->first()[0]) && isset($data->first()[0]->tour_id) && isset($data->first()[0]->operator)){
            $operatorId = Operator::where('name', $data->first()[0]->operator)->first();
            $operatorId = empty($operatorId) ? 0 :  $operatorId->id;
            $operatorTourId = $data->first()[0]->tour_id;

            //1. Checking if current tour exist. If not - create new
            $tour = Tour::where('operators_tour_id', $operatorTourId)->where('operator_id', $operatorId)->first();
            if(empty($tour)){
                $dataToImport = CreateTourData::fromRequest($data->first()[0]);
                $import = $action->execute($dataToImport);
            } else {
                //2. If exist - check if the data has been updated. If not - skip
                $dataEqual = $this->isDataUpdated($data->first()[0], $tour);
                if(!$dataEqual){
                    $data = new UpdateTourData($tour, $data->first()[0]);
                    $updateAction->execute($data);
                }
            }
        }

        return 0;
    }

    private function isDataUpdated(Collection $data, Tour $oldRecord):bool{

        if($data->price != $oldRecord->price || $data->title != $oldRecord->price){
            return false;
        }
        return true;
    }
}
