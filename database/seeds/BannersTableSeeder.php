<?php

use Illuminate\Database\Seeder;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('banners')->truncate();

        DB::table('banners')->insert([
        		['heading' => 'Welcome to Hotel', 'subheading' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 'image' => 'banner_1.jpg'],
        	]);
    }
}
