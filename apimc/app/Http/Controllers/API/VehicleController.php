<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;

class VehicleController extends Controller
{
    /**
     * Return a list of results from NHTSA.
     * @param year number
     * @param manufacturer string
     * @param model string
     *
     * @return json
     *{
     *  Count: <NUMBER OF RESULTS>,
     *    Results: [
     *        {
     *            Description: "<VEHICLE DESCRIPTION>",},
     *            VehicleId: <VEHICLE ID>
     *        {
     *            Description: "<VEHICLE DESCRIPTION>",},
     *            VehicleId: <VEHICLE ID>
     *        },
     *        {
     *            Description: "<VEHICLE DESCRIPTION>",},
     *            VehicleId: <VEHICLE ID>
     *        }
     *    ]
     * }
     */
    public function results(Request $request)
    {
        $year = $request->year;
        $manufacturer = $request->manufacturer;
        $model = $request->model;

        $client = new \GuzzleHttp\Client();
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
            $response = ResponseHelper::formatter(json_decode($body));
            return $response;
        } catch (RequestException $e) {
            return response()->json(
                ['Count' => 0, 'Results' => []],
                404
            );
        }
    }
}
