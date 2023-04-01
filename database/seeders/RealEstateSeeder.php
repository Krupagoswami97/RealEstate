<?php

namespace Database\Seeders;

use App\Models\RealEstate;
use Illuminate\Database\Seeder;

class RealEstateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*------ Note: Generate 30 records in database using seeder ----*/
        RealEstate::factory()->count(30)->create();
    }
}
