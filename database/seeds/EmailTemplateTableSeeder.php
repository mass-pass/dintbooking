<?php

use Illuminate\Database\Seeder;

class EmailTemplateTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('email_templates')->truncate();

        DB::table('email_templates')->insert([
            ['temp_id' 	=> 1,
            'subject' 	=> "Your Payout information has been updated in {site_name}",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            We hope this message finds you well. Your {site_name} payout account information was recently changed on {date_time}. To help keep your account secure, we wanted to reach out to confirm that you made this change. Feel free to disregard this message if you updated your payout account information on {date_time}.
                            <br><br>
                            If you did not make this change to your account, please contact us.<br>",
            'lang' 		=> 'en', 
            'type' 		=> 'email', 
            'lang_id' 	=> 1],

            ['temp_id' 	=> 2,
            'subject' 	=> "Your Payout information has been updated in {site_name}",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            Your {site_name} payout information was updated on {date_time}.<br>",
            'lang' 		=> 'en', 
            'type' 		=> 'email', 
            'lang_id' 	=> 1],

            ['temp_id' 	=> 3,
            'subject' 	=> "Your Payout information has been deleted in {site_name}",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            Your {site_name} payout information was deleted on {date_time}.<br>",
            'lang' 		=> 'en', 
            'type' 		=> 'email', 
            'lang_id' 	=> 1],

            ['temp_id' 	=> 4,
            'subject' 	=> "Booking inquiry for {property_name}",
            'body' 		=> "Hi {owner_first_name},
                            <br><br>
            				<h1>Respond to {user_first_name}’s Inquiry</h1>
            				<br>
            				{total_night} {night/nights} at {property_name}
            				<br>
            				{messages_message}
            				<br>
            				Property Name:  {property_name}
            				<br>
            				Number of Guest: {total_guest}
            				<br>
            				Number of Night: {total_night}
            				<br>
                            Check in Time: {start_date}",
            'lang' 		=> 'en', 
            'type' 		=> 'email', 
            'lang_id' 	=> 1],

            ['temp_id' 	=> 5,
            'subject' 	=> "Please confirm your e-mail address",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            Welcome to {site_name}! Please confirm your account.",
            'lang' 		=> 'en', 
            'type' 		=> 'email', 
            'lang_id' 	=> 1],

            ['temp_id' 	=> 6,
            'subject' 	=> "Reset your Password",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            Your requested password reset link is below. If you didn't make the request, just ignore this email.",
            'lang' 		=> 'en', 
            'type' 		=> 'email', 
            'lang_id' 	=> 1],

            ['temp_id' 	=> 7,
            'subject' 	=> "Please set a payment account",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            Amount {currency_symbol}{payout_amount} is waiting for you but you did not add any payout account to send the money. Please add a payout method.",
            'lang' 		=> 'en', 
            'type' 		=> 'email', 
            'lang_id' 	=> 1],

            ['temp_id' 	=> 8,
            'subject' 	=> "Payout Sent",
            'body' 		=> "Hi {first_name},
                            <br><br>
                            We've issued you a payout of  {currency_symbol}{payout_amount} via PayPal. This payout should arrive in your account, taking into consideration weekends and holidays.",
            'lang' 		=> 'en', 
            'type' 		=> 'email', 
            'lang_id' 	=> 1],

            ['temp_id' 	=> 9,
            'subject' 	=> "Booking Cancelled",
            'body' 		=> "Hi {owner_first_name},
                            <br><br>
                            {user_first_name} cancelled booking of {property_name}.<br>",
            'lang' 		=> 'en', 
            'type' 		=> 'email', 
            'lang_id' 	=>  1],

            ['temp_id'  => 10,
            'subject'   => "Booking {Accepted/Declined}",
            'body'      => "Hi {guest_first_name},
                            <br><br>
                            {host_first_name} {Accepted/Declined} the booking of {property_name}.<br>",
            'lang'      => 'en', 
            'type'      => 'email', 
            'lang_id'   => 1],

            ['temp_id'     => 11,
            'subject'   => "Booking request send for {property_name}",
            'body'      => "Hi {user_first_name},
                            <br><br>
                            <h1>Booking request send to {owner_first_name}</h1>
                            <br>
                            {total_night} {night/nights} at {property_name}
                            <br>
                            Property Name:  {property_name}
                            <br>
                            Number of Guest: {total_guest}
                            <br>
                            Number of Night: {total_night}
                            <br>
                            Check in Time: {start_date}",
            'lang'      => 'en', 
            'type'      => 'email', 
            'lang_id'   => 1],
            
        ]);
        
    }
}
