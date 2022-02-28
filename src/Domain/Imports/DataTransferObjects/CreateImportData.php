<?php

namespace Domain\Imports\DataTransferObjects;

use Domain\App\Models\Operator;
use Domain\Imports\Models\Import;
use Illuminate\Http\Request;

class CreateImportData
{
    public function __construct(
        public array $images,
        public int $operator_id = 0,
        public int $price = 0,
        public string $title = "",
    ) {
        //
    }

    /**
     * @param Request $request
     * @param Import $import
     * @return CreateImportData
     */
    public static function fromRequest($request): CreateImportData
    {
        $filtered = collect($request->images)->filter(function ($value, $key) {
            return self::checkRemoteFile($value);
        });
        $operatorId = Operator::where('name', $request->operator)->first();
        $operatorId = empty($operatorId) ? 0 :  $operatorId->id;

        return new self(
            $filtered->toArray(),
            $operatorId,
            $request->price,
            $request->title,
        );
    }

    private static function checkRemoteFile($value)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$value);

        // don't download content
        curl_setopt($ch, CURLOPT_NOBODY, 1);
        curl_setopt($ch, CURLOPT_FAILONERROR, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        $result = curl_exec($ch);
        curl_close($ch);

        if($result !== FALSE)
        {
            return true;
        }
        return false;
    }
}
