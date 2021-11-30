<?php

use Illuminate\Database\Seeder;

class DomainsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('domains')->truncate();

        DB::table('domains')->insert([
        	['field' => 'guest_domain', 'value' => 0],
            ['field' => 'partner_domain', 'value' => 0],
        ]);
    }
}
