<?php

use Illuminate\Database\Seeder;

class SpaceTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('space_type')->truncate();
        
        DB::table('space_type')->insert([
            ['name' => 'Entire home/apt','description' => 'Entire home/apt'],
            ['name' => 'Private room','description' => 'Private room'],
            ['name' => 'Shared room','description' => 'Shared room']
        ]);
    }
}
