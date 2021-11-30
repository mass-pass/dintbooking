<?php

use Illuminate\Database\Seeder;

class AmenitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('amenities')->truncate();
    	
        DB::table('amenities')->insert([
        		['type_id' => '1', 'title' => 'Essentials','description' => 'Towels, bed sheets, soap and toilet paper','symbol' => 'essentials'],
        		['type_id' => '1', 'title' => 'TV','description' => '','symbol' => 'tv'],
        		['type_id' => '1', 'title' => 'Cable TV','description' => '','symbol' => 'desktop'],
        		['type_id' => '1', 'title' => 'Air Conditioning ','description' => '','symbol' => 'air-conditioning'],
        		['type_id' => '1', 'title' => 'Heating','description' => 'Heating','symbol' => 'heating'],
        		['type_id' => '1', 'title' => 'Kitchen','description' => 'Kitchen','symbol' => 'meal'],
        		['type_id' => '1', 'title' => 'Internet','description' => 'Internet','symbol' => 'internet'],
        		['type_id' => '1', 'title' => 'Gym','description' => 'Gym','symbol' => 'gym'],
        		['type_id' => '1', 'title' => 'Elevator in Building','description' => '','symbol' => 'elevator'],
        		['type_id' => '1', 'title' => 'Indoor Fireplace','description' => '','symbol' => 'fireplace'],
        		['type_id' => '1', 'title' => 'Buzzer/Wireless Intercom','description' => '','symbol' => 'intercom'],
        		['type_id' => '1', 'title' => 'Doorman','description' => '','symbol' => 'doorman'],
        		['type_id' => '1', 'title' => 'Shampoo','description' => '','symbol' => 'smoking'],
        		['type_id' => '1', 'title' => 'Wireless Internet','description' => 'Wireless Internet','symbol' => 'wifi'],
                ['type_id' => '1', 'title' => 'Hot Tub','description' => '','symbol' => 'hot-tub'],
                ['type_id' => '1', 'title' => 'Washer','description' => 'Washer','symbol' => 'washer'],
                ['type_id' => '1', 'title' => 'Pool','description' => 'Pool','symbol' => 'pool'],
                ['type_id' => '1', 'title' => 'Dryer','description' => 'Dryer','symbol' => 'dryer'],
                ['type_id' => '1', 'title' => 'Breakfast','description' => 'Breakfast','symbol' => 'cup'],
                ['type_id' => '1', 'title' => 'Free Parking on Premises','description' => '','symbol' => 'parking'],
                ['type_id' => '1', 'title' => 'Family/Kid Friendly','description' => 'Family/Kid Friendly','symbol' => 'family'],
        		['type_id' => '1', 'title' => 'Smoking Allowed','description' => '','symbol' => 'smoking'],
        		['type_id' => '1', 'title' => 'Suitable for Events','description' => 'Suitable for Events','symbol' => 'balloons'],
        		['type_id' => '1', 'title' => 'Pets Allowed','description' => '','symbol' => 'paw'],
        		['type_id' => '1', 'title' => 'Pets live on this property','description' => '','symbol' => 'ok'],
        		['type_id' => '1', 'title' => 'Wheelchair Accessible','description' => 'Wheelchair Accessible','symbol' => 'accessible'],
        		['type_id' => '2', 'title' => 'Smoke Detector','description' => 'Smoke Detector','symbol' => 'ok'],
        		['type_id' => '2', 'title' => 'Carbon Monoxide Detector','description' => 'Carbon Monoxide Detector','symbol' => 'ok'],
        		['type_id' => '2', 'title' => 'First Aid Kit','description' => '','symbol' => 'ok'],
        		['type_id' => '2', 'title' => 'Safety Card','description' => 'Safety Card','symbol' => 'ok'],
        		['type_id' => '2', 'title' => 'Fire Extinguisher','description' => 'Essentials','symbol' => 'ok'],
        	]);
    }
}
