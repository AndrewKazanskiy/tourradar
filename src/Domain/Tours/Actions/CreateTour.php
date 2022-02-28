<?php

namespace Domain\Tours\Actions;

use Domain\App\Models\Image;
use Domain\Tours\DataTransferObjects\CreateTourData;
use Domain\Tours\Models\Tour;

class CreateTour
{
    /**
     * @param CreateTourData $data
     */
    public function execute(CreateTourData $data)
    {
        $tour = Tour::create([
            'operator_id' => $data->operator_id,
            'price' => $data->price,
            'title' => $data->title,
            'operators_tour_id' => $data->operator_tour_id
        ]);

        foreach ($data->images as $link) {
            //TODO:post processing images, saving images to AWS S3 or local storage
            $image = Image::create(['link' =>$link, 'tour_id' => $tour->id]);
        }

        return $tour;
    }
}
