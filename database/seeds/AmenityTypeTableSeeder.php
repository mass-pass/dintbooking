<?php

use Illuminate\Database\Seeder;

class AmenityTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('amenity_type')->truncate();
    	
        DB::table('amenity_type')->insert([
        		['name' => 'Common Amenities','description' => ''],
  				['name' => 'Safety Amenities','description' => ''],
        	]);
    }
}
