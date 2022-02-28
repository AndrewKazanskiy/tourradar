<?php

namespace Domain\Imports\DataTransferObjects;

use Domain\Imports\Models\Import;
use Domain\Tours\Models\Tour;
use Illuminate\Http\Request;


class UpdateImportData
{
    public Import $import;
    public ?string $title = null;
    public int $operator_id;
    public int $price;

    /**
     * UpdateImportData constructor.
     */
    public function __construct(Import $import, Request $request)
    {
        $this->import = $import;
        $this->operator_id = $request->get('operator_id');
        $this->price = $request->get('price');
        $this->title = $request->get('title');

    }
}
