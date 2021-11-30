<?php

use Illuminate\Database\Seeder;

class PropertyFeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_fees')->truncate();

        DB::table('property_fees')->insert([
        	['field' => 'more_then_seven', 'value' => 0],
            ['field' => 'less_then_seven', 'value' => 0],
            ['field' => 'host_service_charge', 'value' => 0],
            ['field' => 'guest_service_charge', 'value' => 5],
            ['field' => 'cancel_limit', 'value' => 0],
            ['field' => 'currency', 'value' => 'USD'],
            ['field' => 'host_penalty', 'value' => 0]
        ]);
    }
}
