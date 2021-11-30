<?php

use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
		DB::table('properties')->truncate();
		
		DB::table('properties')->insert([
              'id' => '1',  
              'name' => 'w Condo', 
              'slug' => 'WCondo', 
              'host_id' => '1',
              'bedrooms' => '1',  
              'beds' => '1', 
              'slug' => 'WCondo', 
              'property_type' => '1',
              'accommodates' => '1',
            ]);    
            DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        }
    }
    