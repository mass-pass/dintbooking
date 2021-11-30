<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $this->call(AmenityTypeTableSeeder::class);
      $this->call(AmenitiesTableSeeder::class);
      $this->call(BannersTableSeeder::class);
      $this->call(BedTypeTableSeeder::class);
      $this->call(CountryTableSeeder::class);
      $this->call(CurrencyTableSeeder::class);
      $this->call(LanguageTableSeeder::class);
      $this->call(MessageTypeTableSeeder::class);
      $this->call(PagesTableSeeder::class);
      $this->call(PaymentMethodsTableSeeder::class);
      $this->call(PermissionsTableSeeder::class);
      $this->call(PropertyTypeTableSeeder::class);
      $this->call(RolesTableSeeder::class);
      $this->call(RulesTableSeeder::class);
      $this->call(SeoMetasTableSeeder::class);
      $this->call(SettingsTableSeeder::class);
      $this->call(StartingCitiesTableSeeder::class);
      $this->call(PropertyFeesTableSeeder::class);
      $this->call(SpaceTypeTableSeeder::class);
      $this->call(TimezoneTableSeeder::class);
      $this->call(EmailTemplateTableSeeder::class);
      $this->call(TestimonialTableSeeder::class);
      //$this->call(ResetDataSeeder::class);
      // $this->call(AdminUserSeeder::class);
    }
}
