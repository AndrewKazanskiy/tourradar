<?php

namespace Domain\Tours\Actions;

use Domain\App\Models\Image;
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
    public function execute(UpdateTourData $data):void
    {
        $data->tour->update([
            'price' => $data->price,
            'title' => $data->title,
        ]);

        $tourImages = $data->tour->images();

        //adding New images
        foreach ($data->images as $link) {
            //TODO:post processing images, saving images to AWS S3 or local storage
            if (!$tourImages->contains($link)) {
                $image = Image::create(['link' => $link, 'tour_id' => $data->tour->id]);
            }
        }
        //deleting old images
        foreach ($tourImages as $image) {
            //TODO:post processing images, saving images to AWS S3 or local storage
            if (!in_array($image->link, $data->images)) {
                $image->delete();
            }
        }

    }
}
