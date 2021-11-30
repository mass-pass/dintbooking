<?php

use Illuminate\Database\Seeder;

class MessageTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      DB::table('message_type')->truncate();

      DB::table('message_type')->insert([
        ['id' => '1', 'name' => 'query'],
        ['id' => '2', 'name' => 'guest_cancellation' ],
        ['id' => '3', 'name' => 'host_cancellation'],
        ['id' => '4', 'name' => 'booking_request'],
        ['id' => '5', 'name' => 'booking_accecpt'],
        ['id' => '6', 'name' => 'booking_decline'],
        ['id' => '7', 'name' => 'booking_expire'],
              
      ]);
    }
}