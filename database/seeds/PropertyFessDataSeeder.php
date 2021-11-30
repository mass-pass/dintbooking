<?php

use Illuminate\Database\Seeder;

class PropertyFessDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('property_fees')->insert([
            ['field' => 'partner_service_charge', 'value' => 0],
        ]);
    }
}
