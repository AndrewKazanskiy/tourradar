<?php

namespace Domain\Tours\DataTransferObjects;

use Domain\Tours\Models\Tour;
use Illuminate\Http\Request;

class CreateTourData
{
    public function __construct(
        public Tour $tour,
        public int $operator_id = 0,
        public int $price = 0,
        public string $title = "",
    ) {
        //
    }

    /**
     * @param Request $request
     * @param Tour $tour
     * @return CreateTourData
     */
    public static function fromRequest(Request $request, Tour $tour): CreateTourData
    {
        return new self(
            $tour,
            $request->input('operator_id'),
            $request->input('price'),
            $request->input('title'),
        );
    }
}
