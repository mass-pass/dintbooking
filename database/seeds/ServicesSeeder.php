<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ServicesSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    DB::table('services')->truncate();

    $loremIpsum = "Sevices";

    DB::table('services')->insert([
      [
        'title' => 'Housekeeping', 'slug' => 'housekeeping',
        'sub_title' => 'Lorem Ipsum is simply dummy text of the',
        'description' => $loremIpsum, 'record_id' => Str::uuid()
      ],
      [
        'title' => 'Massage Therapist', 'slug' => 'massage-therapist',
        'sub_title' => 'Lorem Ipsum is simply dummy text of the',
        'description' => $loremIpsum, 'record_id' => Str::uuid()
      ],
      [
        'title' => 'Handymen', 'slug' => 'handymen',
        'sub_title' => 'Lorem Ipsum is simply dummy text of the',
        'description' => $loremIpsum, 'record_id' => Str::uuid()
      ],
      [
        'title' => 'Plumbing', 'slug' => 'plumbing',
        'sub_title' => 'Lorem Ipsum is simply dummy text of the',
        'description' => $loremIpsum, 'record_id' => Str::uuid()
      ],
      [
        'title' => 'Private Chef', 'slug' => 'private-chef',
        'sub_title' => 'Lorem Ipsum is simply dummy text of the',
        'description' => $loremIpsum, 'record_id' => Str::uuid()
      ],
      [
        'title' => 'Private Yoga', 'slug' => 'private-yoga',
        'sub_title' => 'Lorem Ipsum is simply dummy text of the',
        'description' => $loremIpsum, 'record_id' => Str::uuid()
      ],
    ]);
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
  }
}
