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
    protected function formatter($response, $withRating)
    {
        $jsonResponse = new \stdClass();
        $jsonResponse->Count = $response->Count;
        $jsonResponse->Results = [];
        foreach ($response->Results as $key => $value) {
            $result = new \stdClass();
            $result->VehicleId = $value->VehicleId;
            $result->Description = $value->VehicleDescription;
            if ($withRating == 'true') {
                $result->CrashRating = $this->rating($value->VehicleId);
            }
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
    public static function client($year, $manufacturer, $model, $withRating)
    {
        $client = new \GuzzleHttp\Client();
        if (! is_numeric($year)) {
            abort(400);
        }
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
            $response = (new self)->formatter(json_decode($body), $withRating);
            return $response;
        } catch (RequestException $e) {
            return response()->json(['Count' => 0, 'Results' => []], 404);
        }
    }

    public function rating($vehicleId)
    {
        $client = new \GuzzleHttp\Client();
        try {
            $body = $client->request(
                'GET',
                sprintf(
                    'https://one.nhtsa.gov/webapi/api/SafetyRatings/VehicleId/%s?format=json',
                    $vehicleId
                )
            )->getBody();
            $response = json_decode($body);
            return $response->Results[0]->OverallRating;
        } catch (RequestException $e) {
            return "Not Rated";
        }
    }
}
