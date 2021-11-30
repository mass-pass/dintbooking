<?php

use Illuminate\Database\Seeder;

class PropertyCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_category')->truncate();

        DB::table('property_category')->insert([
            ['id' => '1', 'name' => 'GuestHouse', 'description' => 'Private room with separate facilities for host and guests.'],
            ['id' => '2', 'name' => 'Bed and breakfast', 'description' => 'Private home offering overnight stays and breakfast.'],
            ['id' => '3', 'name' => 'Homestay', 'description' => 'A shared where the guest has a private room and host lives and is on-site some facilities are shared between host and guest.'],
            ['id' => '4', 'name' => 'Country house', 'description' => 'Private home with simple commendation in the countryside.'],
            ['id' => '5', 'name' => 'Condo hotel', 'description' => 'A self catering apartment with some hotel facilities like a reception desk.'],
            ['id' => '6', 'name' => 'Farm stay', 'description' => 'Private farm with simple accommodation.'],
            ['id' => '7', 'name' => 'Ludge', 'description' => 'Private home with accommodation surrounding by nature, such as mountains or forest.'],
        ]);
    }
}
