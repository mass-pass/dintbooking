<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Wallet;
use App\Models\RoleAdmin;
use App\Models\PermissionRole;
class ResetDataSeeder extends Seeder
{

    public function run()
    {
        DB::table('admin')->truncate();
        DB::table('accounts')->truncate();
        DB::table('bookings')->truncate();
        DB::table('booking_details')->truncate();
        DB::table('messages')->truncate();
        DB::table('payouts')->truncate();
        DB::table('payout_penalties')->truncate();
        DB::table('penalty')->truncate();
        DB::table('properties')->truncate();
        DB::table('property_address')->truncate();
        DB::table('property_beds')->truncate();
        DB::table('property_dates')->truncate();
        DB::table('property_description')->truncate();
        DB::table('property_details')->truncate();
        DB::table('property_fees')->truncate();
        DB::table('property_photos')->truncate();
        DB::table('property_price')->truncate();
        DB::table('property_rules')->truncate();
        DB::table('property_steps')->truncate();
        DB::table('users')->truncate();
        DB::table('users_verification')->truncate();
        DB::table('user_details')->truncate();
        DB::table('wallets')->truncate();
        DB::table('withdrawals')->truncate();
        DB::table('payout_settings')->truncate();


        $this->call(AmenityTypeTableSeeder::class);
        $this->call(AmenitiesTableSeeder::class);
        $this->call(BannersTableSeeder::class);
        $this->call(BedTypeTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
        $this->call(MessageTypeTableSeeder::class);
        $this->call(PagesTableSeeder::class);
        //$this->call(PaymentMethodsTableSeeder::class);
        //$this->call(PermissionsTableSeeder::class);
        $this->call(PropertyTypeTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        //$this->call(RulesTableSeeder::class);
        $this->call(SeoMetasTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(StartingCitiesTableSeeder::class);
        $this->call(PropertyFeesTableSeeder::class);
        $this->call(SpaceTypeTableSeeder::class);
        //$this->call(TimezoneTableSeeder::class);


        DB::table('admin')->insert(['username' => 'admin', 'email' => 'max@dint.com', 'password' => Hash::make('123456'), 'status' => 'Active', 'created_at' => date('Y-m-d H:i:s')] );
        
        $role_user           = new RoleAdmin;
        $role_user->truncate();
        $role_user->admin_id = 1;
        $role_user->role_id  = '1';
        $role_user->save();

        $data = [
                    ['permission_id' => 1, 'role_id' => '1'],
                    ['permission_id' => 2, 'role_id' => '1'],
                    ['permission_id' => 3, 'role_id' => '1'],
                    ['permission_id' => 4, 'role_id' => '1'],
                    ['permission_id' => 5, 'role_id' => '1'],
                    ['permission_id' => 6, 'role_id' => '1'],
                    ['permission_id' => 7, 'role_id' => '1'],
                    ['permission_id' => 8, 'role_id' => '1'],
                    ['permission_id' => 9, 'role_id' => '1'],
                    ['permission_id' => 10, 'role_id' => '1'],
                    ['permission_id' => 11, 'role_id' => '1'],
                    ['permission_id' => 12, 'role_id' => '1'],
                    ['permission_id' => 13, 'role_id' => '1'],
                    ['permission_id' => 14, 'role_id' => '1'],
                    ['permission_id' => 15, 'role_id' => '1'],
                    ['permission_id' => 16, 'role_id' => '1'],
                    ['permission_id' => 17, 'role_id' => '1'],
                    ['permission_id' => 18, 'role_id' => '1'],
                    ['permission_id' => 19, 'role_id' => '1'],
                    ['permission_id' => 20, 'role_id' => '1'],
                    ['permission_id' => 21, 'role_id' => '1'],
                    ['permission_id' => 22, 'role_id' => '1'],
                    ['permission_id' => 23, 'role_id' => '1'],
                    ['permission_id' => 24, 'role_id' => '1'],
                    ['permission_id' => 25, 'role_id' => '1'],
                    ['permission_id' => 26, 'role_id' => '1'],
                    ['permission_id' => 27, 'role_id' => '1'],
                    ['permission_id' => 28, 'role_id' => '1'],
                    ['permission_id' => 29, 'role_id' => '1'],
                    ['permission_id' => 30, 'role_id' => '1'],
                    ['permission_id' => 31, 'role_id' => '1'],
                    ['permission_id' => 32, 'role_id' => '1'],
                    ['permission_id' => 33, 'role_id' => '1'],
                    ['permission_id' => 35, 'role_id' => '1'],
                    ['permission_id' => 36, 'role_id' => '1'],
                    ['permission_id' => 37, 'role_id' => '1'],
                    ['permission_id' => 38, 'role_id' => '1'],
                    ['permission_id' => 39, 'role_id' => '1'],
                    ['permission_id' => 40, 'role_id' => '1'],
                    ['permission_id' => 41, 'role_id' => '1'],
                ];
        PermissionRole::truncate();
        PermissionRole::insert($data);

        User::insert( ['first_name' => 'test', 'last_name' => 'user', 'email' => 'test@techvill.net', 'profile_image' => 'profile.png', 'password' => Hash::make('123456'), 'status' => 'Active', 'created_at' => date('Y-m-d H:i:s')] );   

        User::insert( ['first_name' => 'customer', 'last_name' => 'user', 'email' => 'customer@techvill.net', 'profile_image' => 'profile.jpg', 'password' => Hash::make('123456'), 'status' => 'Active', 'created_at' => date('Y-m-d H:i:s')] );

        Wallet::insert(['user_id' => 1, 'currency_id' => 1, 'balance' => 10, 'is_active' => 1 ]);
        
        Wallet::insert(['user_id' => 2, 'currency_id' => 1, 'balance' => 10, 'is_active' => 1 ]);
        
        DB::table('users_verification')->insert(['user_id' => 1, 'email' => 'yes']);
        DB::table('users_verification')->insert(['user_id' => 2, 'email' => 'yes']);
        
        DB::table('properties')->insert([
            ['name' => 'Hampton Inn', 'url_name' => NULL, 'host_id' => 1, 'bedrooms' => 10, 'beds' => 10, 'bed_type' => 1, 'bathrooms' => 8.00, 'amenities' => '1,2,4,5,7,9,10,29,30,31', 'property_type' => 1, 'space_type' => 1, 'accommodates' => 16, 'booking_type' => 'request', 'cancellation' => 'Flexible', 'status' => 'Listed', 'recomended' => 1],
            ['name' => 'North Sydney Harbourview Hotel', 'url_name' => NULL, 'host_id' => 1, 'bedrooms' => 10, 'beds' => 15, 'bed_type' => 2, 'bathrooms' => 8.00, 'amenities' => '1,3,4,5,6,7,8,9,10,27,28', 'property_type' => 2, 'space_type' => 2, 'accommodates' => 15, 'booking_type' => 'request', 'cancellation' => 'Flexible', 'status' => 'Listed', 'recomended' => 1],
            ['name' => 'Hotel Paris Rivoli', 'url_name' => NULL, 'host_id' => 1, 'bedrooms' => 10, 'beds' => 16, 'bed_type' => 3, 'bathrooms' => 8.00, 'amenities' => '1,2,4,5,6,11,12,13,14,17,18,19,21', 'property_type' => 3, 'space_type' => 3, 'accommodates' => 10, 'booking_type' => 'request', 'cancellation' => 'Flexible', 'status' => 'Listed', 'recomended' => 1],
            ['name' => 'K+K Picasso', 'url_name' => NULL, 'host_id' => 2, 'bedrooms' => 10, 'beds' => 10, 'bed_type' => 4, 'bathrooms' => 8.00, 'amenities' => '1,3,4,5,6,7,10,11,21,22,23,24,25,26,27,28,29', 'property_type' => 5, 'space_type' => 1, 'accommodates' => 10, 'booking_type' => 'request', 'cancellation' => 'Flexible', 'status' => 'Listed', 'recomended' => 1],
            ['name' => 'CONTACT APEX HOTELS', 'url_name' => NULL, 'host_id' => 2, 'bedrooms' => 5, 'beds' => 10, 'bed_type' => 6, 'bathrooms' => 8.00, 'amenities' => '1,3,4,9,10,11,17,18,19,20,21', 'property_type' => 6, 'space_type' => 2, 'accommodates' => 10, 'booking_type' => 'request', 'cancellation' => 'Flexible', 'status' => 'Listed', 'recomended' => 1],
            ['name' => 'City Center Inn & Suites', 'url_name' => NULL, 'host_id' => 2, 'bedrooms' => 5, 'beds' => 8, 'bed_type' => 7, 'bathrooms' => 3.00, 'amenities' => '17,18,19,20,23,24,29', 'property_type' => 7, 'space_type' => 3, 'accommodates' => 8, 'booking_type' => 'instant', 'cancellation' => 'Flexible', 'status' => 'Listed', 'recomended' => 1],
            ['name' => 'Dream House Duplex Villa mayrouba', 'url_name' => NULL, 'host_id' => 1, 'bedrooms' => 5, 'beds' => 8, 'bed_type' => 7, 'bathrooms' => 3.00, 'amenities' => '17,18,19,20,23,24,29', 'property_type' => 7, 'space_type' => 3, 'accommodates' => 8, 'booking_type' => 'instant', 'cancellation' => 'Flexible', 'status' => 'Listed', 'recomended' => 1],
            ['name' => 'Fresh & Airy Private Bushwick Bedroom', 'url_name' => NULL, 'host_id' => 2, 'bedrooms' => 5, 'beds' => 8, 'bed_type' => 7, 'bathrooms' => 3.00, 'amenities' => '17,18,19,20,23,24,29', 'property_type' => 7, 'space_type' => 3, 'accommodates' => 8, 'booking_type' => 'instant', 'cancellation' => 'Flexible', 'status' => 'Listed', 'recomended' => 1]
 
        ]);

        DB::table('property_address')->insert([
            [ 'property_id' => 1, 'address_line_1' => 'New York City Hall, New York, NY 10007, USA', 'address_line_2' => '851 8th Ave, New York, NY, US, 10019', 'latitude' => '40.7127461', 'longitude' => '-74.00597399999998', 'city' => 'New York', 'state' => 'New York', 'country' => 'US', 'postal_code' => '10007'],
            [ 'property_id' => 2, 'address_line_1' => 'MLC Centre, 108 King St, Sydney NSW 2000, Australia', 'address_line_2' => NULL, 'latitude' => '-33.8686949', 'longitude' => '151.2092424', 'city' => 'Sydney', 'state' => 'New South Wales', 'country' => 'AU', 'postal_code' => '2000'],
            [ 'property_id' => 3, 'address_line_1' => '19 Rue de Rivoli, 75004 Paris, France', 'address_line_2' => NULL, 'latitude' => '48.8559431', 'longitude' => '2.3573452000000543', 'city' => 'Paris', 'state' => 'Île-de-France', 'country' => 'FR', 'postal_code' => '75004'],
            [ 'property_id' => 4, 'address_line_1' => 'Passeig de Picasso, 26, 08003 Barcelona, Spain', 'address_line_2' => NULL, 'latitude' => '41.3866227', 'longitude' => '2.184072199999946', 'city' => 'Barcelona', 'state' => 'Catalunya', 'country' => 'ES', 'postal_code' => '08003'],
            [ 'property_id' => 5, 'address_line_1' => '12 Stacey St, London WC2H, UK', 'address_line_2' => NULL, 'latitude' => '51.5142805', 'longitude' => '-0.12846539999998186', 'city' => 'London', 'state' => 'England', 'country' => 'GB', 'postal_code' => 'WC2H'],
            [ 'property_id' => 6, 'address_line_1' => '240 7th St, San Francisco, CA 94103, USA', 'address_line_2' => NULL, 'latitude' => '37.7771788', 'longitude' => '-122.40894029999998', 'city' => 'SF', 'state' => 'California', 'country' => 'US', 'postal_code' => '94103'],
            [ 'property_id' => 7, 'address_line_1' => '240 7th St, San Francisco, CA 94103, USA', 'address_line_2' => NULL, 'latitude' => '37.7771788', 'longitude' => '-122.40894029999998', 'city' => 'SF', 'state' => 'California', 'country' => 'US', 'postal_code' => '94103'],
            [ 'property_id' => 8, 'address_line_1' => '12 Stacey St, London WC2H, UK', 'address_line_2' => NULL, 'latitude' => '51.5142805', 'longitude' => '-0.12846539999998186', 'city' => 'London', 'state' => 'England', 'country' => 'GB', 'postal_code' => 'WC2H'],
        ]);

        DB::table('property_description')->insert([
            ['property_id' => 1, 'summary' => 'A stay at Hampton Inn Times Square North places you in the heart of New York, walking distance from Studio 54 and Ed Sullivan Theater. This hotel is close to Broadway and Rockefeller Center.'],
            ['property_id' => 2, 'summary' => 'The View Hotels comprise three hotels within Australia located in three of the most beautiful and exciting cities – Sydney, Melbourne and Brisbane.'],
            ['property_id' => 3, 'summary' => 'Situated in the famous Marais district surrounded by boutiques, monuments and museums, the Hotel Paris Rivoli offers three-star accommodations in the most desirable part of Paris.'],
            ['property_id' => 4, 'summary' => 'K+K Picasso offers 4-star elegance in Barcelona’s El Born district, directly opposite Parc de la Ciutadella and Barcelona Zoo on Passeig de Picasso. The hotel has avant-garde architecture, a rooftop pool with city views and is less than 15 minutes’ walk from La Rambla, Barceloneta Beach and the Gothic Quarter.'],
            ['property_id' => 5, 'summary' => 'CONTACT APEX HOTELS'],
            ['property_id' => 6, 'summary' => 'Set in the SoMA neighborhood, this straightforward hotel with an annex is 1 mile from Union Square\'s shopping, 1.5 miles from Chinatown and 2.5 miles from Fisherman\'s Wharf\'s seafood restaurants.'],
            ['property_id' => 7, 'summary' => 'Private luxury bungalow with astonishing view , cozy in winter cold covered with snow and chill in the summer with private pool .Excellent location for celebration of small and big group enjoying chimney fire as well as spacious terrace For ski lovers , it is the perfect location 10 min away from faraya where road are always open even with extreme winter condition'],
            ['property_id' => 8, 'summary' => 'Experience the best of Brooklyn’s creative scene just steps from this renovated, furnished apartment, fully equipped with everything you need to get settled in — all you have to bring is your suitcase! Walk outside and find yourself in the heart of Bushwick, renowned for its street art and bustling community. This apartment includes access to the backyard, perfect for getting time outdoors, and is just a short walk from the neighborhood’s largest park.'],
        ]);

        DB::table('property_photos')->insert([
            ['property_id' => 1, 'photo' => 'property-1.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 1, 'photo' => 'property-2.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 1, 'photo' => 'property-3.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 1, 'photo' => 'property-4.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 1, 'photo' => 'property-34.jpg', 'message' => NULL, 'cover_photo' => 0],

            ['property_id' => 2, 'photo' => 'property-6.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 2, 'photo' => 'property-7.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 2, 'photo' => 'property-8.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 2, 'photo' => 'property-9.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 2, 'photo' => 'property-35.jpg', 'message' => NULL, 'cover_photo' => 0],

            ['property_id' => 3, 'photo' => 'property-10.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 3, 'photo' => 'property-11.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 3, 'photo' => 'property-12.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 3, 'photo' => 'property-13.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 3, 'photo' => 'property-36.jpg', 'message' => NULL, 'cover_photo' => 0],

            ['property_id' => 4, 'photo' => 'property-14.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 4, 'photo' => 'property-15.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 4, 'photo' => 'property-16.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 4, 'photo' => 'property-17.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 4, 'photo' => 'property-37.jpg', 'message' => NULL, 'cover_photo' => 0],

            ['property_id' => 5, 'photo' => 'property-18.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 5, 'photo' => 'property-19.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 5, 'photo' => 'property-20.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 5, 'photo' => 'property-21.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 5, 'photo' => 'property-38.jpg', 'message' => NULL, 'cover_photo' => 0],

            ['property_id' => 6, 'photo' => 'property-22.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 6, 'photo' => 'property-23.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 6, 'photo' => 'property-24.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 6, 'photo' => 'property-25.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 6, 'photo' => 'property-39.jpg', 'message' => NULL, 'cover_photo' => 0],

            ['property_id' => 7, 'photo' => 'property-26.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 7, 'photo' => 'property-27.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 7, 'photo' => 'property-28.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 7, 'photo' => 'property-29.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 7, 'photo' => 'property-40.jpg', 'message' => NULL, 'cover_photo' => 0],
            
            ['property_id' => 8, 'photo' => 'property-30.jpg', 'message' => NULL, 'cover_photo' => 1],
            ['property_id' => 8, 'photo' => 'property-31.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 8, 'photo' => 'property-32.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 8, 'photo' => 'property-33.jpg', 'message' => NULL, 'cover_photo' => 0],
            ['property_id' => 8, 'photo' => 'property-41.jpg', 'message' => NULL, 'cover_photo' => 0],
        ]);

        DB::table('property_price')->insert([
            ['property_id' => 1, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 5, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 2, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 6, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 3, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 7, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 4, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 8, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 5, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 20, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 6, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 120, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 7, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 100, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
            ['property_id' => 8, 'cleaning_fee' => 0, 'guest_after' => 1, 'guest_fee' => 0, 'security_fee' => 0, 'price' => 200, 'weekend_price' => 0, 'weekly_discount' => 0, 'monthly_discount' => 0, 'currency_code' => 'USD'],
        ]);

        DB::table('property_steps')->insert([
            ['property_id' => 1, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 2, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 3, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 4, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 5, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 6, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 7, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
            ['property_id' => 8, 'basics' => 1, 'description' => 1, 'location' => 1, 'photos' => 1, 'pricing' => 1, 'booking' => 1],
        ]);

        /*DB::table('settings')->where('name', 'head_code')
       ->update(['value' => "<script>
                  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
                  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

                  ga('create', 'UA-85305348-1', 'auto');
                  ga('send', 'pageview');
                </script>"]);*/
    }
}
