<?php

namespace Domain\Tours\Actions;

use Domain\Tours\DataTransferObjects\UpdateTourData;

class UpdateTour
{
    /**
     * UpdateEmployee constructor.
     */
    public function __construct()
    {
        //
    }

    /**
     * @param UpdateTourData $data
     */
    public function execute(UpdateTourData $data)
    {
        $data->tour->update([
            'operator_id' => $data->operator_id,
            'price' => $data->price,
            'title' => $data->title,
        ]);
    }
}
