<?php

use Illuminate\Database\Seeder;

class UserTypesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('user_types')->truncate();
        
        DB::table('user_types')->insert([
                ['id' => 1 , 'user_type_name' => 'General'],
                ['id' => 2 , 'user_type_name' => 'Host']
        ]);
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
