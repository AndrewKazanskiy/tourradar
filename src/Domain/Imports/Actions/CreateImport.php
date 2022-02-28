<?php

namespace Domain\Imports\Actions;

use Domain\Imports\DataTransferObjects\CreateImportData;
use Domain\Imports\Models\Import;

class CreateImport
{
    /**
     * @param CreateImportData $data
     */
    public function execute(CreateImportData $data)
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
