<?php

namespace Domain\Tours\Actions;

use Domain\Imports\Models\Import;
use Domain\Tours\DataTransferObjects\CreateTourData;

class CreateTour
{
    /**
     * @param CreateTourData $data
     */
    public function execute(CreateTourData $data)
    {
        $importOperator = Import::create([
            'operator_id' => $data->operator_id,
            'price' => $data->price,
            'title' => $data->title,
        ]);

        $importOperator->overwriteImages($data->images);

        return $importOperator;
    }
}
