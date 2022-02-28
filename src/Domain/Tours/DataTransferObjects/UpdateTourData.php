<?php

namespace Domain\Tours\DataTransferObjects;

use Domain\App\Models\Operator;
use Domain\Tours\Models\Tour;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class UpdateTourData
{
    public Tour $tour;
    public array $images;
    public ?string $title = null;
    public int $price;

    /**
     * UpdateTourData constructor.
     */
    public function __construct(Tour $tour, Collection $data)
    {
        $filtered = collect($data->images)->filter(function ($value, $key) {
            return CreateTourData::checkRemoteFile($value);
        });

        $this->tour = $tour;
        $this->images = $filtered->toArray();
        $this->price = $data->price;
        $this->title = $data->price;

    }
}
