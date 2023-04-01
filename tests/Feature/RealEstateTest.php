<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\RealEstate;
use Carbon\Carbon;

class RealEstateTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    /**
     * A feature test to get all real estate data
     *
     * @return void
     */
    public function get_all_real_estates()
    {
        $this->get('/api/real_estate')
            ->assertStatus(200);
    }

    /**
     * A feature test to add a new real estate data
     *
     * @return void
     */
    public function add_real_estate()
    {
        $payload = [
            "name" => rand(),
            "real_estate_type" => "Department",
            "street" => "Xyz",
            "external_number" => "ABC-D",
            "internal_number" => "ABC",
            "neighborhood" => "Jk",
            "city" => "Florida",
            "country" => "US",
            "rooms" => "1",
            "bathrooms" => "1",
            "comments" => "XYZ",
            "create_at" => Carbon::now(),
            "update_at" => Carbon::now()
        ];

        $this->json('POST', 'api/real_estate', $payload)
            ->assertStatus(200);
    }

    /**
     * A feature test to get specific real estate data
     *
     * @return void
     */
    public function show_real_estate()
    {
        $RealEstateId = random_int(1, 1000);

        $this->json('get', 'api/real_estate/' . $RealEstateId)
            ->assertStatus(200);
    }

    /**
     * A feature test to update a new real estate data
     *
     * @return void
     */
    public function update_real_estate()
    {
        $RealEstateData = RealEstate::first();
        $payload = [
            "name" => rand(),
            "real_estate_type" => "Land",
            "street" => "Xyz",
            "external_number" => "ABC-D",
            "internal_number" => "",
            "neighborhood" => "Jk",
            "city" => "Surat",
            "country" => "IN",
            "rooms" => "1",
            "bathrooms" => "1",
            "comments" => "XYZ",
            "create_at" => Carbon::now(),
            "update_at" => Carbon::now()
        ];

        $this->json('PUT', 'api/real_estate/'.$RealEstateData->id, $payload)
            ->assertStatus(200);
    }

    /**
     * A feature test to delete a real estate data
     *
     * @return void
     */
    public function delete_real_estate()
    {
        $RealEstateId = random_int(100000, 999999);

        $this->json('DELETE', 'api/real_estate/' . $RealEstateId)
            ->assertStatus(200);
    }

}
