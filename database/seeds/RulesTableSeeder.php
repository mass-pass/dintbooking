<?php

use Illuminate\Database\Seeder;

class RulesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('rules')->truncate();

        DB::table('rules')->insert([
  				    ['message' => 'Suitable for children (2-12 years)'],
                    ['message' => 'Suitable for infants (Under 2 years)'],
                    ['message' => 'Suitable for pets'],
                    ['message' => 'Smoking allowed'],
                    ['message' => 'Events or parties allowed'],
        	]);
    }
}
