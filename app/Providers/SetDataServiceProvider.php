<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Models\{
    Currency,
    Language,
    Settings,
    StartingCities,
    JoinUs,
    Banners,
    Page
};

use View, Config, Schema, Auth, App, Session, Validator, Cache;


class SetDataServiceProvider extends ServiceProvider
{
    public function boot()
    {

        if (env('DB_DATABASE') != '') {
            if (Schema::hasTable('currency')) {
                $this->currency();
            }
            
            if (Schema::hasTable('language')) {
                $this->language();
            }
            
            if (Schema::hasTable('settings')) {
                $this->settings();
                
                $this->api_info_set();
            }
            if (Schema::hasTable('pages')) {
                $this->pages();
            }
            
            if (Schema::hasTable('starting_cities')) {
                $this->destination();
            }
            
            $this->creditcard_validation();
            
        }
    }

    public function creditcard_validation()
    {
    
        Validator::extend('expires', function ($attribute, $value, $parameters, $validator) {
            $input      = $validator->getData();
            $expiryDate = gmdate('Ym', gmmktime(0, 0, 0, (int) array_get($input, $parameters[0]), 1, (int) array_get($input, $parameters[1])));
            return ($expiryDate > gmdate('Ym')) ? true : false;
        });

        Validator::extend('validate_cc', function ($attribute, $value, $parameters) {
            $str = '';
            foreach (array_reverse(str_split($value)) as $i => $c) {
                $str .= $i % 2 ? $c * 2 : $c;
            }
            return array_sum(str_split($str)) % 10 === 0;
        });
    }

    public function register()
    {
        //
    }
    
    public function currency()
    {
        ini_set('max_execution_time', 300);
        $currency = Currency::where('status', '=', 'Active')->pluck('code', 'code');
        View::share('currency', $currency);

        $currencies = Currency::where('status', '=', 'Active')->select('code', 'name', 'symbol')->get();
        View::share('currencies', $currencies);

        $ip      = $_SERVER["REMOTE_ADDR"] ?? ' ';
        $result  = @unserialize(file_get_contents('http://www.geoplugin.net/php.gp?ip='.$ip));
        if (!empty($result['geoplugin_currencyCode'])) {
            $default_currency = Currency::where('status', '=', 'Active')->where('code', '=', $result['geoplugin_currencyCode'])->first();
            if (!empty($default_currency)) {
                $default_currency = Currency::where('status', '=', 'Active')->where('default', '=', '1')->first();
            }
        } else {
            $default_currency = Currency::where('status', '=', 'Active')->where('default', '=', '1')->first();
        }
        
        if (!$default_currency) {
            $default_currency = Currency::where('status', '=', 'Active')->first();
        }
        
        if (isset($default_currency->code)) {
            Session::put('currency', $default_currency->code);
            $symbol = Currency::code_to_symbol($default_currency->code);
            Session::put('symbol', $symbol);
        }
        View::share('default_currency', $default_currency);
        if(!empty($result['geoplugin_countryCode'])) {
            View::share('default_country', $result['geoplugin_countryCode']);
        } else {
            View::share('default_country', 'US');  
        }
    }
    
    public function language()
    {
        $language = Language::where('status', '=', 'Active')->pluck('name', 'short_name');
        View::share('language', $language);
        
        $default_language = Language::where('status', '=', 'Active')->where('default', '=', '1')->limit(1)->get();
        View::share('default_language', $default_language);
        if ($default_language->count() > 0) {
            Session::put('language', $default_language[0]['short_name']);
            App::setLocale($default_language[0]['short_name']);
        }
    }
    
    public function pages()
    {
        $footer_first  = Page::where('position', 'first')->where('status', 'Active')->get();
        $footer_second = Page::where('position', 'second')->where('status', 'Active')->get();
        View::share('footer_first', $footer_first);
        View::share('footer_second', $footer_second);
    }

    public function destination()
    {
        $popular_cities  = StartingCities::where('status', 'Active')->get();
        View::share('popular_cities', $popular_cities);
    }
    
    public function api_info_set()
    {
        $google   = Settings::where('type', 'google')->pluck('value', 'name')->toArray();
        $facebook = Settings::where('type', 'facebook')->pluck('value', 'name')->toArray();
        if (isset($google['client_id'])) {
            \Config::set(['services.google' => [
                    'client_id' => $google['client_id'],
                    'client_secret' => $google['client_secret'],
                    'redirect' => url('/googleAuthenticate'),
                    ]
                ]);
        }

        if (isset($facebook['client_id'])) {
             \Config::set(['services.facebook' => [
                        'client_id' => $facebook['client_id'],
                        'client_secret' => $facebook['client_secret'],
                        'redirect' => url('/facebookAuthenticate'),
                        ]
                        ]);
        }
    }


    public function settings()
    { 
        $settings = Settings::getAll();
        if (!empty($settings)) {
            
            // General settings
            $general = $settings->where('type', 'general')->pluck('value', 'name')->toArray();
            
            $name = $general['name'] ?? env('APP_NAME', 'Vacation Rental');

            if (!defined('SITE_NAME')) {
                define('SITE_NAME', $name);
            }
            View::share('site_name', $name);
            Config::set('site_name', $name);

 
            //App logo
$logo = env('APP_LOGO_URL') ;
if (!defined('APP_LOGO_URL')) {
                define('APP_LOGO_URL', $logo);
            }

            View::share('logo', $logo);
           


            //App email logo
            if (!empty($general['email_logo']) && file_exists(public_path('front/images/logos/'. $general['email_logo']))) {
                $emailLogo = url('front/images/logos/'. $general['email_logo']);
            } else {
                $emailLogo = env('APP_EMAIL_LOGO_URL') != '' ? env('APP_EMAIL_LOGO_URL') : url('front/images/logos/email_logo.png');
            }
            if (!defined('EMAIL_LOGO_URL')) {
                define('EMAIL_LOGO_URL', $emailLogo);
            }

            //App head code/Analytics code
            $headCode = !empty($general['head_code']) ? $general['head_code'] : env('APP_HEAD_CODE', '');
            View::share('head_code', $headCode);
          
            //App favicon
            if (!empty($general['favicon']) && file_exists(public_path('front/images/logos/'. $general['favicon']))) {
              
                $favicon = url('front/images/logos/'. $general['favicon']);
            } else {
                $favicon = env('APP_FAVICON_URL') != '' ? env('APP_FAVICON_URL') : url('front/images/logos/favicon.png');
            }
            View::share('favicon', $favicon);

            // Google Map Key
            $map     = $settings->where('type', 'googleMap')->pluck('value', 'name')->toArray();
            if (!empty($map['key'])) {
                    View::share('map_key', $map['key']);
                    if(!defined('MAP_KEY')){
                        define('MAP_KEY', $map['key']);
                    }
            }

            // Join us
            $join_us = Settings::where('type', 'join_us')->get();
            View::share('join_us', $join_us);

            View::share('settings', $settings);
        }

        //App Banner 
        $banner = Banners::first();

        if ( !empty($banner) && isset($general['logo']) && file_exists(public_path('front/images/logos/'. $general['logo'])) )
        {
            $banner_image = url('front/images/banners/'.$banner->image);
        } else {
            $banner_image = url('images/default-banner.jpg');
        }

        define('BANNER_URL', $banner_image);
        if ( !defined('BANNER_URL') ) {
            define('BANNER_URL', $banner_image);
        }

    }
}
