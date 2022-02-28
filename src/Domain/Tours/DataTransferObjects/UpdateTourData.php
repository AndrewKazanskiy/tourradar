<?php

namespace Domain\Tours\DataTransferObjects;

use Domain\Tours\Models\Tour;
use Illuminate\Http\Request;


class UpdateTourData
{
    public Tour $tour;
    public ?string $title = null;
    public int $operator_id;
    public int $price;

    /**
     * UpdateTourData constructor.
     */
    public function __construct(Tour $tour, Request $request)
    {
        $this->tour = $tour;
        $this->operator_id = $request->get('operator_id');
        $this->price = $request->get('price');
        $this->title = $request->get('title');

    }
}
