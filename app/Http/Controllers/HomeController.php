<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use App\Http\Controllers\Controller;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Cache;


use View, Auth, App, Session, Route;

use App\Models\{
    Currency,
    Properties,
    Page,
    Settings,
    StartingCities,
    Testimonials,
    Banners,
    Language,
    Admin,
    User,
    Wallet
};


require base_path() . '/vendor/autoload.php';

class HomeController extends Controller
{
    private $helper;
    
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(Request $request)
    {
        
        $data['starting_cities'] = StartingCities::getAll();
        $data['banners']              = Banners::all();
        $data['properties']          = Properties::recommendedHome();
        $data['testimonials']        = Testimonials::getAll();
        $sessionLanguage             = Session::get('language');
        $language                    = Settings::where(['name' => 'default_language', 'type' => 'general'])->first();
        
        $languageDetails             = language::where(['id' => $language->value])->first();

        if (!($sessionLanguage)) {
            Session::pull('language');
            Session::put('language', $languageDetails->short_name);
            App::setLocale($languageDetails->short_name);
        }

        $pref = Settings::getAll();

        $prefer = [];

        if (!empty($pref)) {
            foreach ($pref as $value) {
                $prefer[$value->name] = $value->value;
            }
            Session::put($prefer);
        }

        return view('home.home', $data); 
    }
    
    public function phpinfo()
    {
        echo phpinfo();
    }

    public function login()
    {
        return view('home.login');
    }

    public function setSession(Request $request)
    {
        if ($request->currency) {
            Session::put('currency', $request->currency);
            $symbol = Currency::code_to_symbol($request->currency);
            Session::put('symbol', $symbol);
        } elseif ($request->language) {
            Session::put('language', $request->language);
            $name = language::name($request->language);
            Session::put('language_name', $name);
            App::setLocale($request->language);
        }
    }

    public function cancellation_policies()
    {
        return view('home.cancellation_policies');
    }

    public function staticPages(Request $request)
    {
        if(isset($request->name)) {
            $pages = Page::where(['url'=>$request->name, 'status'=>'Active']);
        } else {
            $pages = array();
        }
        
        if (!isset($pages)) {
            abort('404');
        }
        $pages           = $pages->first();
        $data['content'] = str_replace(['SITE_NAME', 'SITE_URL'], [SITE_NAME, url('/')], $pages->content);
        $data['title']   = $pages->url;
        $data['url']     = url('/').'/';
        $data['img']     = $data['url'].'images/2222hotel_room2.jpg';

        return view('home.static_pages', $data);
    }


    public function walletUser(Request $request){

        $users = User::all();
        $wallet = Wallet::all();


        if (!$users->isEmpty() && $wallet->isEmpty() ) {
            foreach ($users as $key => $user) {

                Wallet::create([
                    'user_id' => $user->id,
                    'currency_id' => 1,
                    'balance' => 0,
                    'is_active' => 0
                ]);
            }
        }

        return redirect('/');

    }
    
}
