<?php

use Illuminate\Database\Seeder;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('language')->truncate();
      
        DB::table('language')->insert([
            ['name' => 'English','short_name' => 'en','default' => '1','status' => 'Active'],
            ['name' => 'عربى','short_name' => 'ar','default' => '0','status' => 'Active'],
            ['name' => '中文 (繁體)','short_name' => 'ch','default' => '0','status' => 'Active'],
            ['name' => 'Français','short_name' => 'fr','default' => '0','status' => 'Active'],
            ['name' => 'Português','short_name' => 'pt','default' => '0','status' => 'Active'],
            ['name' => 'Русский','short_name' => 'ru','default' => '0','status' => 'Active'],
            ['name' => 'Español','short_name' => 'es','default' => '0','status' => 'Active'],
            ['name' => 'Türkçe','short_name' => 'tr','default' => '0','status' => 'Active']
        ]);
		DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
