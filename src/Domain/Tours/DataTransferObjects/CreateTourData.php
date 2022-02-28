<?php

namespace Domain\Tours\DataTransferObjects;

use Domain\App\Models\Operator;
use Domain\Tours\Models\Tour;
use Illuminate\Http\Request;

class CreateTourData
{
    public function __construct(
        public array $images,
        public int $operator_id = 0,
        public int $price = 0,
        public string $title = "",
        public int $operator_tour_id = 0
    ) {
        //
    }

    /**
     * @param $data
     * @param Tour $tour
     * @return CreateTourData
     */
    public static function fromRequest($data): CreateTourData
    {
        $filtered = collect($data->images)->filter(function ($value, $key) {
            return self::checkRemoteFile($value);
        });
        $operatorId = Operator::where('name', $data->operator)->first();
        $operatorId = empty($operatorId) ? 0 :  $operatorId->id;

        return new self(
            $filtered->toArray(),
            $operatorId,
            $data->price,
            $data->title,
            $data->tour_id
        );
    }

    /**
     * @param string $value
     * @return bool
     */
    public static function checkRemoteFile($value)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$value);

        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        return $result !== false;
    }
}
