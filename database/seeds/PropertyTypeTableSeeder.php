<?php

use Illuminate\Database\Seeder;

class PropertyTypeTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('property_type')->truncate();
		
		DB::table('property_type')->insert([
			['name' => 'Apartment', 'description' => 'Apartment'],
			['name' => 'House', 'description' => 'House'],
			['name' => 'Bed & Break Fast', 'description' => 'Bed & Break Fast'],
			['name' => 'Loft', 'description' => 'Loft'],
			['name' => 'Townhouse', 'description' => 'Townhouse'],
			['name' => 'Condominium', 'description' => 'Condominium'],
			['name' => 'Bungalow', 'description' => 'Bungalow'],
			['name' => 'Cabin', 'description' => 'Cabin'],
			['name' => 'Villa', 'description' => 'Villa'],
			['name' => 'Castle', 'description' => 'Castle'],
			['name' => 'Dorm', 'description' => 'Dorm'],
			['name' => 'Treehouse', 'description' => 'Treehouse'],
			['name' => 'Boat', 'description' => 'Boat'],
			['name' => 'Plane', 'description' => 'Plane'],
			['name' => 'Camper/RV', 'description' => 'Camper/RV'],
			['name' => 'Lgloo', 'description' => 'Lgloo'],
			['name' => 'Lighthouse', 'description' => 'Lighthouse'],
			['name' => 'Yurt', 'description' => 'Yurt'],
			['name' => 'Tipi', 'description' => 'Tipi'],
			['name' => 'Cave', 'description' => 'Cave'],
			['name' => 'Island', 'description' => 'Island'],
			['name' => 'Chalet', 'description' => 'Chalet'],
			['name' => 'Earth House', 'description' => 'Earth House'],
			['name' => 'Hut', 'description' => 'Hut'],
			['name' => 'Train', 'description' => 'Train'],
			['name' => 'Tent', 'description' => 'Tent'],
			['name' => 'Other', 'description' => 'Other'],
			['name' => 'Vacation Home', 'description' => 'Vacation Home'],
		]);    
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
	}
}
