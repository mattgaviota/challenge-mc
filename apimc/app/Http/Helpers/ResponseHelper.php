<?php

namespace App\Http\Helpers;
use GuzzleHttp\Exception\RequestException;

class ResponseHelper
{
    /**
     * Response formatter
     *
     * @param  $response stdClass
     * @return json
     */
    protected function formatter($response)
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

    /**
     * Response formatter
     *
     * @param  $year String
     * @param  $manufacturer String
     * @param  $model String
     * @return json
     */
    public static function client($year, $manufacturer, $model)
    {
        $client = new \GuzzleHttp\Client();
        if (! $year or ! $manufacturer or ! $model) {
            abort(400);
        }
        try {
            $body = $client->request(
                'GET',
                sprintf(
                    'https://one.nhtsa.gov/webapi/api/SafetyRatings/modelyear/%d/make/%s/model/%s?format=json',
                    $year,
                    $manufacturer,
                    $model
                )
            )->getBody();
            $response = (new self)->formatter(json_decode($body));
            return $response;
        } catch (RequestException $e) {
            return response()->json(['Count' => 0, 'Results' => []], 404);
        }
    }
}
