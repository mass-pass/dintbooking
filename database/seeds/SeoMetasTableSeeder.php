<?php

use Illuminate\Database\Seeder;

class SeoMetasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('seo_metas')->truncate();

        DB::table('seo_metas')->insert([
                ['url' => '/', 'title' => 'Home | Dint Home', 'description' => 'Buy, sell and download photos', 'keywords' => ''],
                ['url' => 'login', 'title' => 'Log In', 'description' => 'Log In', 'keywords' => ''],
                ['url' => 'register', 'title' => 'Register', 'description' => 'Register', 'keywords' => ''],
                ['url' => 'newest', 'title' => 'Newest Photos', 'description' => 'Newest Photos', 'keywords' => ''],
                ['url' => 'forgot_password', 'title' => 'Forgot Password', 'description' => 'Forgot Password', 'keywords' => ''],
                ['url' => 'dashboard', 'title' => 'Feeds', 'description' => 'Feeds', 'keywords' => ''],
                ['url' => 'uploads', 'title' => 'Uploads', 'description' => 'Uploads', 'keywords' => ''],
                ['url' => 'notification', 'title' => 'Notification', 'description' => 'Notification', 'keywords' => ''],
                ['url' => 'profile', 'title' => 'Profile', 'description' => 'Profile', 'keywords' => ''],
                ['url' => 'profile/{id}', 'title' => 'Profile', 'description' => 'Profile', 'keywords' => ''],
                ['url' => 'manage-photos', 'title' => 'Manage Photos', 'description' => 'Manage Photos', 'keywords' => ''],
                ['url' => 'earning', 'title' => 'Earning', 'description' => 'Earning', 'keywords' => ''],
                ['url' => 'purchase', 'title' => 'Purchase', 'description' => 'Purchase', 'keywords' => ''],
                ['url' => 'settings', 'title' => 'Settings', 'description' => 'Settings', 'keywords' => ''],
                ['url' => 'settings/account', 'title' => 'Settings', 'description' => 'Settings', 'keywords' => ''],
                ['url' => 'settings/payment', 'title' => 'Settings', 'description' => 'Settings', 'keywords' => ''],
                ['url' => 'photo/single/{id}', 'title' => 'Photo Single', 'description' => 'Photo Single', 'keywords' => ''],
                ['url' => 'payments/success', 'title' => 'Payment Success', 'description' => 'Payment Success', 'keywords' => ''],
                ['url' => 'payments/cancel', 'title' => 'Payment Cancel', 'description' => 'Payment Cancel', 'keywords' => ''],
                ['url' => 'profile-uploads/{type}', 'title' => 'Profile Uploads', 'description' => 'Profile Uploads', 'keywords' => ''],
            	['url' => 'photo-details/{id}', 'title' => 'Photo Details', 'description' => 'Photo Details', 'keywords' => ''],
                ['url' => 'withdraws', 'title' => 'Withdraws', 'description' => 'Withdraws', 'keywords' => ''],
                ['url' => 'photos/download/{id}', 'title' => 'Photos Download', 'description' => 'Photos Download', 'keywords' => ''],
            	['url' => 'users/reset_password/{secret?}', 'title' => 'Reset Password', 'description' => 'Reset Password', 'keywords' => ''],
                ['url' => 'search/{word}', 'title' => 'Search Result', 'description' => 'Search Result', 'keywords' => ''],
                ['url' => 'search/user/{word}', 'title' => 'Search User Result', 'description' => 'Search User Result', 'keywords' => ''],
                ['url' => 'signup', 'title' => 'Signup', 'description' => 'Signup', 'keywords' => ''],
                ['url' => 'property/create', 'title' => 'Create New Property', 'description' => 'Create New Property', 'keywords' => ''],

                ['url' => 'listing/{id}/{step}', 'title' => 'Property Listing', 'description' => 'Property Listing', 'keywords' => ''],

                ['url' => 'properties', 'title' => 'Properties', 'description' => 'Properties', 'keywords' => ''],
                ['url' => 'my_bookings', 'title' => 'My Bookings', 'description' => 'My Bookings', 'keywords' => ''],

                ['url' => 'trips/active', 'title' => 'Your Trips', 'description' => 'Your Trips', 'keywords' => ''],

                ['url' => 'users/profile', 'title' => 'Edit Profile', 'description' => 'Edit Profile', 'keywords' => ''],

                ['url' => 'users/account_preferences', 'title' => 'Account Preferences', 'description' => 'Account Preferences', 'keywords' => ''],

                ['url' => 'users/transaction_history', 'title' => 'Transaction History', 'description' => 'Transaction History', 'keywords' => ''],

                 ['url' => 'users/security', 'title' => 'Security', 'description' => 'Security', 'keywords' => ''],

                ['url' => 'search', 'title' => 'Search', 'description' => 'Search', 'keywords' => ''],

                ['url' => 'inbox', 'title' => 'Inbox', 'description' => 'Inbox', 'keywords' => ''],

                ['url' => 'users/profile/media', 'title' => 'Profile Photo', 'description' => 'Profile Photo', 'keywords' => ''],
                
                ['url' => 'booking/requested', 'title' => 'Payment Completed', 'description' => 'Payment Completed', 'keywords' => ''],

            ]);
    }
}
