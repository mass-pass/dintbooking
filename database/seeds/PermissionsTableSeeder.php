<?php

use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();

        DB::table('permissions')->insert([
              ['id' => '1', 'name' => 'manage_admin', 'display_name' => 'Manage Admin', 'description' => 'Manage Admin Users'],
              ['id' => '2', 'name' => 'customers', 'display_name' => 'View Customers', 'description' => 'View Customer'],
              ['id' => '3', 'name' => 'add_customer', 'display_name' => 'Add Customer', 'description' => 'Add Customer'],
              ['id' => '4', 'name' => 'edit_customer', 'display_name' => 'Edit Customer', 'description' => 'Edit Customer'],
              ['id' => '5', 'name' => 'properties', 'display_name' => 'View Properties', 'description' => 'View Properties'],
              ['id' => '6', 'name' => 'add_properties', 'display_name' => 'Add Properties', 'description' => 'Add Properties'],
              ['id' => '7', 'name' => 'edit_properties', 'display_name' => 'Edit Properties', 'description' => 'Edit Properties'],
              ['id' => '8', 'name' => 'delete_property', 'display_name' => 'Delete Property', 'description' => 'Delete Property'],
              ['id' => '9', 'name' => 'manage_bookings', 'display_name' => 'Manage Bookings', 'description' => 'Manage Bookings'],
              ['id' => '10', 'name' => 'manage_email_template', 'display_name' => 'Manage Email Template', 'description' => 'Manage Email Template'],
              ['id' => '11', 'name' => 'view_payouts', 'display_name' => 'View Payouts', 'description' => 'View Payouts'],
              ['id' => '12', 'name' => 'manage_amenities', 'display_name' => 'Manage Amenities', 'description' => 'Manage Amenities'],
              ['id' => '13', 'name' => 'manage_pages', 'display_name' => 'Manage Pages', 'description' => 'Manage Pages'],
              ['id' => '14', 'name' => 'manage_reviews', 'display_name' => 'Manage Reviews', 'description' => 'Manage Reviews'],
              ['id' => '15', 'name' => 'view_reports', 'display_name' => 'View Reports', 'description' => 'View Reports'],
              ['id' => '16', 'name' => 'general_setting', 'display_name' => 'Settings', 'description' => 'Settings'],
              ['id' => '17', 'name' => 'preference', 'display_name' => 'Preference', 'description' => 'Preference'],
              ['id' => '18', 'name' => 'manage_banners', 'display_name' => 'Manage Banners', 'description' => 'Manage Banners'],
              ['id' => '19', 'name' => 'starting_cities_settings', 'display_name' => 'Starting Cities Settings', 'description' => 'Starting Cities Settings'],
              ['id' => '20', 'name' => 'manage_property_type', 'display_name' => 'Manage Property Type', 'description' => 'Manage Property Type'],
              ['id' => '21', 'name' => 'space_type_setting', 'display_name' => 'Space Type Setting', 'description' => 'Space Type Setting'],
              ['id' => '22', 'name' => 'manage_bed_type', 'display_name' => 'Manage Bed Type', 'description' => 'Manage Bed Type'],
              ['id' => '23', 'name' => 'manage_currency', 'display_name' => 'Manage Currency', 'description' => 'Manage Currency'],
              ['id' => '24', 'name' => 'manage_country', 'display_name' => 'Manage Country', 'description' => 'Manage Country'],
              ['id' => '25', 'name' => 'manage_amenities_type', 'display_name' => 'Manage Amenities Type', 'description' => 'Manage Amenities Type'],
              ['id' => '26', 'name' => 'email_settings', 'display_name' => 'Email Settings', 'description' => 'Email Settings'],
              ['id' => '27', 'name' => 'manage_fees', 'display_name' => 'Manage Fees', 'description' => 'Manage Fees'],
              ['id' => '28', 'name' => 'manage_language', 'display_name' => 'Manage Language', 'description' => 'Manage Language'],
              ['id' => '29', 'name' => 'manage_metas', 'display_name' => 'Manage Metas', 'description' => 'Manage Metas'],
              ['id' => '30', 'name' => 'api_informations', 'display_name' => 'Api Credentials', 'description' => 'Api Credentials'],
              ['id' => '31', 'name' => 'payment_settings', 'display_name' => 'Payment Settings', 'description' => 'Payment Settings'],
              ['id' => '32', 'name' => 'social_links', 'display_name' => 'Social Links', 'description' => 'Social Links'],
              ['id' => '33', 'name' => 'manage_roles', 'display_name' => 'Manage Roles', 'description' => 'Manage Roles'],
              ['id' => '34', 'name' => 'database_backup', 'display_name' => 'Database Backup', 'description' => 'Database Backup'],
              ['id' => '35', 'name' => 'manage_sms', 'display_name' => 'Manage SMS', 'description' => 'Manage SMS'],
              ['id' => '36', 'name' => 'manage_messages', 'display_name' => 'Manage Messages', 'description' => 'Manage Messages'],
              ['id' => '37', 'name' => 'edit_messages', 'display_name' => 'Edit Messages', 'description' => 'Edit Messages'],
              ['id' => '38', 'name' => 'manage_testimonial', 'display_name' => 'Manage Testimonial', 'description' => 'Manage Testimonial'],
              ['id' => '39', 'name' => 'add_testimonial', 'display_name' => 'Add Testimonial', 'description' => 'Add Testimonial'],
              ['id' => '40', 'name' => 'edit_testimonial', 'display_name' => 'Edit Testimonial', 'description' => 'Edit Testimonial'],
              ['id' => '41', 'name' => 'delete_testimonial', 'display_name' => 'Delete Testimonial', 'description' => 'Delete Testimonial'],
             
        ]);
    }
}
