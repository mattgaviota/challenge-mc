<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\ResponseHelper;


class VehicleController extends Controller
{
    /**
     * Return a list of results from NHTSA.
     * @param $request Request
     * @method GET|POST
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
        $year = $request->modelYear;
        $manufacturer = $request->manufacturer;
        $model = $request->model;
        $withRating = $request->withRating;

        return ResponseHelper::client($year, $manufacturer, $model, $withRating);
    }
}
