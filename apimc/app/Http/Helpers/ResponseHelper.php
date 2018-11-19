<?php

namespace App\Http\Helpers;

class ResponseHelper
{
    /**
     * Response formatter
     *
     * @param  stdClass
     * @return json
     */
    public static function formatter($response)
    {
        $jsonResponse = new \stdClass();
        $jsonResponse->Count = $response->Count;
        $jsonResponse->Results = [];
        foreach ($response->Results as $key => $value) {
            $result = new \stdClass();
            $result->VehicleId = $value->VehicleId;
            $result->Description = $value->VehicleDescription;
            array_push($jsonResponse->Results, $result);
        }
        return response()->json($jsonResponse);
    }
}
