<?php

use Illuminate\Database\Seeder;

class CurrencyTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currency')->truncate();
    	
        DB::table('currency')->insert([
                ['name' => 'US Dollar','code' => 'USD','symbol' => '&#36;','rate' => '1.00', 'default' => '1'],
                ['name' => 'Pound Sterling','code' => 'GBP','symbol' => '&pound;','rate' => '0.65', 'default' => '0'],
                ['name' => 'Europe','code' => 'EUR','symbol' => '&euro;','rate' => '0.88', 'default' => '0'],
                ['name' => 'Australian Dollar','code' => 'AUD','symbol' => '&#36;','rate' => '1.41', 'default' => '0'],
                ['name' => 'Singapore','code' => 'SGD','symbol' => '&#36;','rate' => '1.41', 'default' => '0'],
                ['name' => 'Swedish Krona','code' => 'SEK','symbol' => 'kr','rate' => '8.24', 'default' => '0'],
                ['name' => 'Danish Krone','code' => 'DKK','symbol' => 'kr','rate' => '6.58', 'default' => '0'],
                ['name' => 'Mexican Peso','code' => 'MXN','symbol' => '$','rate' => '16.83', 'default' => '0'],
                ['name' => 'Brazilian Real','code' => 'BRL','symbol' => 'R$','rate' => '3.88', 'default' => '0'],
                ['name' => 'Malaysian Ringgit','code' => 'MYR','symbol' => 'RM','rate' => '4.31', 'default' => '0'],
                ['name' => 'Philippine Peso','code' => 'PHP','symbol' => 'P','rate' => '46.73', 'default' => '0'],
                ['name' => 'Swiss Franc','code' => 'CHF','symbol' => '&euro;','rate' => '0.97', 'default' => '0'],
                ['name' => 'India','code' => 'INR','symbol' => '&#x20B9;','rate' => '66.24', 'default' => '0'],
                ['name' => 'Argentine Peso','code' => 'ARS','symbol' => '&#36;','rate' => '9.35', 'default' => '0'],
                ['name' => 'Canadian Dollar','code' => 'CAD','symbol' => '&#36;','rate' => '1.33', 'default' => '0'],
                ['name' => 'Chinese Yuan','code' => 'CNY','symbol' => '&#165;','rate' => '6.37', 'default' => '0'],
                ['name' => 'Czech Republic Koruna','code' => 'CZK','symbol' => 'K&#269;','rate' => '23.91', 'default' => '0'],
                ['name' => 'Hong Kong Dollar','code' => 'HKD','symbol' => '&#36;','rate' => '7.75', 'default' => '0'],
                ['name' => 'Hungarian Forint','code' => 'HUF','symbol' => 'Ft','rate' => '276.41', 'default' => '0'],
                ['name' => 'Indonesian Rupiah','code' => 'IDR','symbol' => 'Rp','rate' => '14249.50', 'default' => '0'],
                ['name' => 'Israeli New Sheqel','code' => 'ILS','symbol' => '&#8362;','rate' => '3.86', 'default' => '0'],
                ['name' => 'Japanese Yen','code' => 'JPY','symbol' => '&#165;','rate' => '120.59', 'default' => '0'],
                ['name' => 'South Korean Won','code' => 'KRW','symbol' => '&#8361;','rate' => '1182.69', 'default' => '0'],
                ['name' => 'Norwegian Krone','code' => 'NOK','symbol' => 'kr','rate' => '8.15', 'default' => '0'],
                ['name' => 'New Zealand Dollar','code' => 'NZD','symbol' => '&#36;','rate' => '1.58', 'default' => '0'],
                ['name' => 'Polish Zloty','code' => 'PLN','symbol' => 'z&#322;','rate' => '3.71', 'default' => '0'],
                ['name' => 'Russian Ruble','code' => 'RUB','symbol' => 'p','rate' => '67.75', 'default' => '0'],
                ['name' => 'Thai Baht','code' => 'THB','symbol' => '&#3647;','rate' => '36.03', 'default' => '0'],
                ['name' => 'Turkish Lira','code' => 'TRY','symbol' => '&#8378;','rate' => '3.05', 'default' => '0'],
                ['name' => 'New Taiwan Dollar','code' => 'TWD','symbol' => '&#36;','rate' => '32.47', 'default' => '0'],
                ['name' => 'Vietnamese Dong','code' => 'VND','symbol' => '&#8363;','rate' => '22471.00', 'default' => '0'],
                ['name' => 'South African Rand','code' => 'ZAR','symbol' => 'R','rate' => '13.55', 'default' => '0']
            ]);
    }
}
