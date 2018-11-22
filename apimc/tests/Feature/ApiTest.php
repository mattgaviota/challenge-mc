<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTest extends TestCase
{
    /**
     * Get vehicle test
     *
     * @return void
     */
    public function testGetVehicle()
    {
        $response = $this->json('GET', '/vehicles/2015/Audi/A3');

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 4,
                'Results' => [
                    [
                        "VehicleId" => 9403,
                        "Description" => "2015 Audi A3 4 DR AWD"
                    ],
                    [
                        "VehicleId" => 9408,
                        "Description" => "2015 Audi A3 4 DR FWD"
                    ],
                    [
                        "VehicleId" => 9405,
                        "Description" => "2015 Audi A3 C AWD"
                    ],
                    [
                        "VehicleId" => 9406,
                        "Description" => "2015 Audi A3 C FWD"
                    ]
                ]
            ]);
    }

    /**
     * Get vehicle with rating test
     *
     * @return void
     */
    public function testGetVehicleWithRating()
    {
        $response = $this->json('GET', '/vehicles/2015/Audi/A3?withRating=true');

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 4,
                'Results' => [
                    [
                        "VehicleId" => 9403,
                        "Description" => "2015 Audi A3 4 DR AWD",
                        "CrashRating" => "5"
                    ],
                    [
                        "VehicleId" => 9408,
                        "Description" => "2015 Audi A3 4 DR FWD",
                        "CrashRating" => "5"
                    ],
                    [
                        "VehicleId" => 9405,
                        "Description" => "2015 Audi A3 C AWD",
                        "CrashRating" => "Not Rated"
                    ],
                    [
                        "VehicleId" => 9406,
                        "Description" => "2015 Audi A3 C FWD",
                        "CrashRating" => "Not Rated"
                    ]
                ]
            ]);
    }

    /**
     * Get vehicle failed test
     *
     * @return void
     */
    public function testGetVehicleFailed()
    {
        $response = $this->json('GET', '/vehicles/undefined/Audi/A3');

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 0,
                'Results' => []
            ]);
    }

    /**
     * Get vehicle not found test
     *
     * @return void
     */
    public function testGetVehicleNotFound()
    {
        $response = $this->json('GET', '/vehicles/2015/Ford/Crown Victoria');

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 0,
                'Results' => []
            ]);
    }

    /**
     * Post vehicle test
     *
     * @return void
     */
    public function testPostVehicle()
    {
        $response = $this->json(
            'POST',
            '/vehicles',
            [
                'modelYear' => '2015',
                'manufacturer' => 'Audi',
                'model' => 'A3'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 4,
                'Results' => [
                    [
                        "VehicleId" => 9403,
                        "Description" => "2015 Audi A3 4 DR AWD"
                    ],
                    [
                        "VehicleId" => 9408,
                        "Description" => "2015 Audi A3 4 DR FWD"
                    ],
                    [
                        "VehicleId" => 9405,
                        "Description" => "2015 Audi A3 C AWD"
                    ],
                    [
                        "VehicleId" => 9406,
                        "Description" => "2015 Audi A3 C FWD"
                    ]
                ]
            ]);
    }

    /**
     * Post vehicle with rating test
     *
     * @return void
     */
    public function testPostVehicleWithRating()
    {
        $response = $this->json(
            'POST',
            '/vehicles?withRating=true',
            [
                'modelYear' => '2015',
                'manufacturer' => 'Audi',
                'model' => 'A3'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 4,
                'Results' => [
                    [
                        "VehicleId" => 9403,
                        "Description" => "2015 Audi A3 4 DR AWD",
                        "CrashRating" => "5"
                    ],
                    [
                        "VehicleId" => 9408,
                        "Description" => "2015 Audi A3 4 DR FWD",
                        "CrashRating" => "5"
                    ],
                    [
                        "VehicleId" => 9405,
                        "Description" => "2015 Audi A3 C AWD",
                        "CrashRating" => "Not Rated"
                    ],
                    [
                        "VehicleId" => 9406,
                        "Description" => "2015 Audi A3 C FWD",
                        "CrashRating" => "Not Rated"
                    ]
                ]
            ]);
    }

    /**
     * Post vehicle failed test
     *
     * @return void
     */
    public function testPostVehicleFailed()
    {
        $response = $this->json(
            'POST',
            '/vehicles?withRating=true',
            [
                'manufacturer' => 'Audi',
                'model' => 'A3'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 0,
                'Results' => []
            ]);
    }

    /**
     * Post vehicle not found test
     *
     * @return void
     */
    public function testPostVehicleNotFound()
    {
        $response = $this->json(
            'POST',
            '/vehicles?withRating=true',
            [
                'modelYear' => '2015',
                'manufacturer' => 'Ford',
                'model' => 'Crown Victoria'
            ]
        );

        $response
            ->assertStatus(200)
            ->assertExactJson([
                'Count' => 0,
                'Results' => []
            ]);
    }
}
