<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//$domains = App\Models\Domains::pluck('value', 'field')->toArray();
//
//if(empty($domains)) {
//	$domains = array(
//		'guest_domain' => 'dev.dint.com',
//		'partner_domain' => 'accounts.dint.com'
//	);
//}
$guestDomain = config('services.domain.guest');
$partnerDomain = config('services.domain.partner');

Route::post('set_session', 'HomeController@setSession');

Route::group(['domain' => $guestDomain], function() {

    Route::match(array('GET', 'POST'),'create-users-wallet', 'HomeController@walletUser');
    //cron job
    Route::get('cron', 'CronController@index');
    Route::get('import', 'CronController@importDump');
    Route::get('cron/ical-synchronization','CronController@iCalendarSynchronization');
    Route::group(['prefix' => 'ajax',  'middleware' => ['guest:user']], function(){
     Route::post('booking-notes', 'TripsController@bookingNotes');
     Route::post('booking-misconduct', 'TripsController@bookingBehaviour');
     Route::post('message/create', 'TripsController@reply');
    
    });



   
    //user can view it anytime with or without logged in
    Route::group(['middleware' => ['locale']], function () {
        Route::get('/', 'HomeController@index');
        Route::post('search/boatResult', 'SearchController@searchBoatResult');
        Route::post('search/result', 'SearchController@searchResult');
        Route::get('search', 'SearchController@index');
        Route::get('boat/search', 'SearchController@boatSearch');
        Route::match(array('GET', 'POST'),'properties/{slug}', 'PropertyController@single')->name('property.show');
        Route::match(array('GET', 'POST'),'boats/{slug}', 'BoatsController@single');
        Route::match(array('GET', 'POST'),'property/get-price', 'PropertyController@getPrice');
        Route::get('signup', 'LoginController@signup');
        Route::post('/checkUser/check', 'LoginController@check')->name('checkUser.check');
        /*Create User From Property Listing*/
        Route::match(array('GET', 'POST'),'create-account', 'RegisterController@createAccount')->name('create-account');
        Route::match(array('GET', 'POST'),'contact-details', 'RegisterController@contactDetails')->name('contact-details');
        Route::match(array('GET', 'POST'),'create-password', 'RegisterController@createPassword')->name('create-password');
    });

    //Auth::routes();

    // Route::post('set_session', 'HomeController@setSession');

    //only can view if admin is logged in
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => ['guest:admin']], function(){
        Route::get('/', function(){
            return Redirect::to('admin/dashboard');
        });

        Route::match(array('GET', 'POST'), 'profile', 'AdminController@profile');
        Route::get('logout', 'AdminController@logout');
        Route::get('dashboard', 'DashboardController@index');
        Route::get('customers', 'CustomerController@index')->middleware(['permission:customers']);
        Route::get('customers/customer_search', 'CustomerController@searchCustomer')->middleware(['permission:customers']);
        Route::post('add-ajax-customer', 'CustomerController@ajaxCustomerAdd')->middleware(['permission:add_customer']);
        Route::match(array('GET', 'POST'), 'add-customer', 'CustomerController@add')->middleware(['permission:add_customer']);
        Route::post('booking/dispute', 'BookingsController@dispute');
        Route::group(['middleware' => 'permission:edit_customer'], function () {
            Route::match(array('GET', 'POST'), 'edit-customer/{id}', 'CustomerController@update');
            Route::get('customer/properties/{id}', 'CustomerController@customerProperties');
            Route::get('customer/bookings/{id}', 'CustomerController@customerBookings');
            Route::post('customer/bookings/property_search', 'BookingsController@searchProperty');
            Route::get('customer/payouts/{id}', 'CustomerController@customerPayouts');
            Route::get('customer/payment-methods/{id}', 'CustomerController@paymentMethods');
            Route::get('customer/wallet/{id}', 'CustomerController@customerWallet');
            Route::get('customer/rewards/{id}', 'CustomerController@customerRewards');

            Route::get('customer/properties/{id}/property_list_csv', 'PropertiesController@propertyCsv');
            Route::get('customer/properties/{id}/property_list_pdf', 'PropertiesController@propertyPdf');

            Route::get('customer/bookings/{id}/booking_list_csv', 'BookingsController@bookingCsv');
            Route::get('customer/bookings/{id}/booking_list_pdf', 'BookingsController@bookingPdf');

            Route::get('customer/payouts/{id}/payouts_list_pdf', 'PayoutsController@payoutsPdf');
            Route::get('customer/payouts/{id}/payouts_list_csv', 'PayoutsController@payoutsCsv');

            Route::get('customer/customer_list_csv', 'CustomerController@customerCsv');
            Route::get('customer/customer_list_pdf', 'CustomerController@customerPdf');
        });

        Route::group(['middleware' => 'permission:manage_messages'], function () {
            Route::get('messages', 'AdminController@customerMessage');
            Route::match(array('GET', 'POST'), 'delete-message/{id}', 'AdminController@deleteMessage');
            Route::match(array('GET','POST'), 'send-message-email/{id}', 'AdminController@sendEmail');
            Route::match(['get', 'post'],'upload_image','AdminController@uploadImage')->name('upload');
            Route::get('messaging/host/{id}', 'AdminController@hostMessage');
            Route::post('reply/{id}', 'AdminController@reply');
        });

        Route::get('properties', 'PropertiesController@index')->middleware(['permission:properties']);
        //	Route::match(array('GET', 'POST'), 'add-properties', 'PropertiesController@add')->middleware(['permission:add_properties']);
        Route::get('add-properties', 'PropertiesController@create')->name('admin.properties.create')->middleware(['permission:add_properties']);
        Route::post('add-properties', 'PropertiesController@store')->name('admin.properties.store')->middleware(['permission:add_properties']);
        Route::get('properties/property_list_csv', 'PropertiesController@propertyCsv');
        Route::get('properties/property_list_pdf', 'PropertiesController@propertyPdf');

        Route::group(['middleware' => 'permission:edit_properties'], function () {
            Route::match(array('GET', 'POST'),'listing/{id}/photo-upload', 'PropertiesController@photoUpload');
            Route::match(array('GET', 'POST'),'listing/{id}/photo-selectables', 'PropertiesController@reloadImages');
            Route::match(array('GET', 'POST'),'listing/{id}/photo_message', 'PropertiesController@photoMessage');
            Route::match(array('GET', 'POST'),'listing/{id}/photo_delete', 'PropertiesController@photoDelete');
            Route::match(array('GET', 'POST'),'listing/{id}/update_status', 'PropertiesController@update_status');
            Route::match(array('POST'),'listing/photo/make_default_photo', 'PropertiesController@makeDefaultPhoto');
            Route::match(array('POST'),'listing/photo/make_photo_serial', 'PropertiesController@makePhotoSerial');
            Route::match(array('GET', 'POST'),'listing/{id}/{step}', 'PropertiesController@listing')->where(['id' => '[0-9]+','page' => 'basics|description|location|amenities|photos|pricing|calendar|details|booking']);
        });

        Route::post('ajax-calender/{id}', 'CalendarController@calenderJson');
        Route::post('ajax-calender-price/{id}', 'CalendarController@calenderPriceSet');
        //iCalender routes for admin
        Route::post('ajax-icalender-import/{id}', 'CalendarController@icalendarImport');
        Route::get('icalendar/synchronization/{id}', 'CalendarController@icalendarSynchronization');
        //iCalender routes end
        Route::match(array('GET', 'POST'), 'edit_property/{id}', 'PropertiesController@update')->middleware(['permission:edit_properties']);
        Route::get('delete-property/{id}', 'PropertiesController@delete')->middleware(['permission:delete_property']);
        Route::get('bookings', 'BookingsController@index')->middleware(['permission:manage_bookings']);
        Route::get('bookings/property_search', 'BookingsController@searchProperty')->middleware(['permission:manage_bookings']);
        Route::get('bookings/customer_search', 'BookingsController@searchCustomer')->middleware(['permission:manage_bookings']);
        //booking details
        Route::get('bookings/detail/{id}', 'BookingsController@details')->middleware(['permission:manage_bookings']);
        Route::post('bookings/pay', 'BookingsController@pay')->middleware(['permission:manage_bookings']);
        Route::get('booking/need_pay_account/{id}/{type}', 'BookingsController@needPayAccount');
        Route::get('booking/booking_list_csv', 'BookingsController@bookingCsv');
        Route::get('booking/booking_list_pdf', 'BookingsController@bookingPdf');
        Route::get('payouts', 'PayoutsController@index')->middleware(['permission:view_payouts']);
        Route::match(array('GET', 'POST'), 'payouts/edit/{id}', 'PayoutsController@edit');
        Route::get('payouts/details/{id}', 'PayoutsController@details');
        Route::get('payouts/payouts_list_pdf', 'PayoutsController@payoutsPdf');
        Route::get('payouts/payouts_list_csv', 'PayoutsController@payoutsCsv');
        Route::group(['middleware' => 'permission:manage_reviews'], function () {
            Route::get('reviews', 'ReviewsController@index');
            Route::match(array('GET', 'POST'), 'edit_review/{id}', 'ReviewsController@edit');
            Route::get('reviews/review_search', 'ReviewsController@searchReview');
            Route::get('reviews/review_list_csv', 'ReviewsController@reviewCsv');
            Route::get('reviews/review_list_pdf', 'ReviewsController@reviewPdf');

        });

        // Route::get('reports', 'ReportsController@index')->middleware(['permission:manage_reports']);

        // For Reporting
        Route::group(['middleware' => 'permission:view_reports'], function () {
            Route::get('sales-report', 'ReportsController@salesReports');
            Route::get('sales-analysis', 'ReportsController@salesAnalysis');
            Route::get('reports/property-search', 'ReportsController@searchProperty');
            Route::get('overview-stats', 'ReportsController@overviewStats');
        });

        Route::group(['middleware' => 'permission:manage_amenities'], function () {
            Route::get('amenities', 'AmenitiesController@index');
            Route::match(array('GET', 'POST'), 'add-amenities', 'AmenitiesController@add');
            Route::match(array('GET', 'POST'), 'edit-amenities/{id}', 'AmenitiesController@update');
            Route::get('delete-amenities/{id}', 'AmenitiesController@delete');
        });

        Route::group(['middleware' => 'permission:manage_pages'], function () {
            Route::get('pages', 'PagesController@index');
            Route::match(array('GET', 'POST'), 'add-page', 'PagesController@add');
            Route::match(array('GET', 'POST'), 'edit-page/{id}', 'PagesController@update');
            Route::get('delete-page/{id}', 'PagesController@delete');

        });


        Route::group(['middleware' => 'permission:manage_admin'], function () {
            Route::get('admin-users', 'AdminController@index');
            Route::match(array('GET', 'POST'), 'add-admin', 'AdminController@add');
            Route::match(array('GET', 'POST'), 'edit-admin/{id}', 'AdminController@update');
            Route::match(array('GET', 'POST'), 'delete-admin/{id}', 'AdminController@delete');
        });

        Route::group(['middleware' => 'permission:general_setting'], function () {
            Route::match(array('GET', 'POST'), 'settings', 'SettingsController@general')->middleware(['permission:general_setting']);
            Route::match(array('GET', 'POST'), 'settings/preferences', 'SettingsController@preferences')->middleware(['permission:preference']);
            Route::post('settings/delete_logo', 'SettingsController@deleteLogo');
            Route::post('settings/delete_favicon', 'SettingsController@deleteFavIcon');
            Route::match(array('GET', 'POST'), 'settings/fees', 'SettingsController@fees')->middleware(['permission:manage_fees']);
            Route::match(array('GET', 'POST'), 'settings/domains', 'SettingsController@domains');
            Route::group(['middleware' => 'permission:manage_banners'], function () {
                Route::get('settings/banners', 'BannersController@index');
                Route::match(array('GET', 'POST'), 'settings/add-banners', 'BannersController@add');
                Route::match(array('GET', 'POST'), 'settings/edit-banners/{id}', 'BannersController@update');
                Route::get('settings/delete-banners/{id}', 'BannersController@delete');
            });

            Route::group(['middleware' => 'permission:starting_cities_settings'], function () {
                Route::get('settings/starting-cities', 'StartingCitiesController@index');
                Route::match(array('GET', 'POST'), 'settings/add-starting-cities', 'StartingCitiesController@add');
                Route::match(array('GET', 'POST'), 'settings/edit-starting-cities/{id}', 'StartingCitiesController@update');
                Route::get('settings/delete-starting-cities/{id}', 'StartingCitiesController@delete');
            });

            Route::group(['middleware' => 'permission:manage_property_type'], function () {
                Route::get('settings/property-type', 'PropertyTypeController@index');
                Route::match(array('GET', 'POST'), 'settings/add-property-type', 'PropertyTypeController@add');
                Route::match(array('GET', 'POST'), 'settings/edit-property-type/{id}', 'PropertyTypeController@update');
                Route::get('settings/delete-property-type/{id}', 'PropertyTypeController@delete');
            });

            Route::group(['middleware' => 'permission:space_type_setting'], function () {
                Route::get('settings/space-type', 'SpaceTypeController@index');
                Route::match(array('GET', 'POST'), 'settings/add-space-type', 'SpaceTypeController@add');
                Route::match(array('GET', 'POST'), 'settings/edit-space-type/{id}', 'SpaceTypeController@update');
                Route::get('settings/delete-space-type/{id}', 'SpaceTypeController@delete');
            });

            Route::group(['middleware' => 'permission:manage_bed_type'], function () {
                Route::get('settings/bed-type', 'BedTypeController@index');
                Route::match(array('GET', 'POST'), 'settings/add-bed-type', 'BedTypeController@add');
                Route::match(array('GET', 'POST'), 'settings/edit-bed-type/{id}', 'BedTypeController@update');
                Route::get('settings/delete-bed-type/{id}', 'BedTypeController@delete');
            });

            Route::group(['middleware' => 'permission:manage_currency'], function () {
                Route::get('settings/currency', 'CurrencyController@index');
                Route::match(array('GET', 'POST'), 'settings/add-currency', 'CurrencyController@add');
                Route::match(array('GET', 'POST'), 'settings/edit-currency/{id}', 'CurrencyController@update');
                Route::get('settings/delete-currency/{id}', 'CurrencyController@delete');
            });

            Route::group(['middleware' => 'permission:manage_country'], function () {
                Route::get('settings/country', 'CountryController@index');
                Route::match(array('GET', 'POST'), 'settings/add-country', 'CountryController@add');
                Route::match(array('GET', 'POST'), 'settings/edit-country/{id}', 'CountryController@update');
                Route::get('settings/delete-country/{id}', 'CountryController@delete');
            });

            Route::group(['middleware' => 'permission:manage_amenities_type'], function () {
                Route::get('settings/amenities-type', 'AmenitiesTypeController@index');
                Route::match(array('GET', 'POST'), 'settings/add-amenities-type', 'AmenitiesTypeController@add');
                Route::match(array('GET', 'POST'), 'settings/edit-amenities-type/{id}', 'AmenitiesTypeController@update');
                Route::get('settings/delete-amenities-type/{id}', 'AmenitiesTypeController@delete');
            });

            Route::match(array('GET', 'POST'), 'settings/email', 'SettingsController@email')->middleware(['permission:email_settings']);



            Route::group(['middleware' => 'permission:manage_language'], function () {
                Route::get('settings/language', 'LanguageController@index');
                Route::match(array('GET', 'POST'), 'settings/add-language', 'LanguageController@add');
                Route::match(array('GET', 'POST'), 'settings/edit-language/{id}', 'LanguageController@update');
                Route::get('settings/delete-language/{id}', 'LanguageController@delete');
            });

            Route::match(array('GET', 'POST'), 'settings/fees', 'SettingsController@fees')->middleware(['permission:manage_fees']);

            Route::group(['middleware' => 'permission:manage_metas'], function () {
                Route::get('settings/metas', 'MetasController@index');
                Route::match(array('GET', 'POST'), 'settings/edit_meta/{id}', 'MetasController@update');
            });

            Route::match(array('GET', 'POST'), 'settings/api-informations', 'SettingsController@apiInformations')->middleware(['permission:api_informations']);
            Route::match(array('GET', 'POST'), 'settings/payment-methods', 'SettingsController@paymentMethods')->middleware(['permission:payment_settings']);
            Route::match(array('GET', 'POST'), 'settings/social-links', 'SettingsController@socialLinks')->middleware(['permission:social_links']);

            Route::group(['middleware' => 'permission:manage_roles'], function () {
                Route::get('settings/roles', 'RolesController@index');
                Route::match(array('GET', 'POST'), 'settings/add-role', 'RolesController@add');
                Route::match(array('GET', 'POST'), 'settings/edit-role/{id}', 'RolesController@update');
                Route::get('settings/delete-role/{id}', 'RolesController@delete');
            });

            Route::group(['middleware' => 'permission:database_backup'], function () {
                Route::get('settings/backup', 'BackupController@index');
                Route::get('backup/save', 'BackupController@add');
                Route::get('backup/download/{id}', 'BackupController@download');
            });

            Route::group(['middleware' => 'permission:manage_visitor'], function () {
                //            Route::post('/visitors/list', 'VisitorController@list')->name('visitors.list');
                Route::get('visitors/{id}/destroy','VisitorController@destroy')->name('visitors.destroy');
                Route::resource('visitors', 'VisitorController')->only('index','show');
            });

            Route::group(['middleware' => 'permission:manage_email_template'], function () {
                Route::get('email-template/{id}', 'EmailTemplateController@index');
                Route::post('email-template/{id}','EmailTemplateController@update');
            });

            Route::group(['middleware' => 'permission:manage_testimonial'], function () {
                Route::get('testimonials', 'TestimonialController@index');
                Route::match(array('GET', 'POST'), 'add-testimonials', 'TestimonialController@add');
                Route::match(array('GET', 'POST'), 'edit-testimonials/{id}', 'TestimonialController@update');
                Route::get('delete-testimonials/{id}', 'TestimonialController@delete');
            });
        });
    });

    //only can view if admin is not logged in if they are logged in then they will be redirect to dashboard
    Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'no_auth:admin'], function () {
        Route::get('login', 'AdminController@login');
    });

    //only can view if user is not logged in if they are logged in then they will be redirect to dashboard
    Route::group(['middleware' => ['no_auth:users', 'locale']], function () {
        Route::get('login', 'LoginController@index');
        Route::get('auth/login', function()
        {
            return Redirect::to('login');
        });

        Route::get('googleLogin', 'LoginController@googleLogin');
        Route::get('facebookLogin', 'LoginController@facebookLogin');
        Route::get('register', 'HomeController@register');
        Route::match(array('GET', 'POST'), 'forgot_password', 'LoginController@forgotPassword');
        Route::post('create', 'UserController@create');
        Route::post('authenticate', 'LoginController@authenticate');
        Route::get('users/reset_password/{secret?}', 'LoginController@resetPassword');
        Route::post('users/reset_password', 'LoginController@resetPassword');
    });

    Route::get('googleAuthenticate', 'LoginController@googleAuthenticate');
    Route::get('facebookAuthenticate', 'LoginController@facebookAuthenticate');

    //only can view if user is logged in | USERS
    Route::group(['middleware' => ['guest:users', 'locale']], function () {
        Route::get('dashboard', 'UserController@dashboard')->name('user_dashboard');
        Route::match(array('GET', 'POST'),'users/profile', 'UserController@profile')->name('user_profile');
        Route::match(array('GET', 'POST'),'users/profile/media', 'UserController@media')->name('user_profile_media');
        Route::match(array('GET', 'POST'),'users/profile/photo_delete', 'UserController@photoDelete')->name('user_profile_photo_delete');
        Route::match(array('GET', 'POST'),'users/profile/photo_upload', 'UserController@photoUpload')->name('user_profile_photo_upload');

        // User verification
        Route::get('users/edit-verification', 'UserController@verification');
        Route::get('users/confirm_email/{code?}', 'UserController@confirmEmail');
        Route::get('users/new_email_confirm', 'UserController@newConfirmEmail');

        Route::get('facebookLoginVerification', 'UserController@facebookLoginVerification');
        Route::get('facebookConnect/{id}', 'UserController@facebookConnect');
        Route::get('facebookDisconnect', 'UserController@facebookDisconnectVerification');

        Route::get('googleLoginVerification', 'UserController@googleLoginVerification');
        Route::get('googleConnect/{id}', 'UserController@googleConnect');
        Route::get('googleDisconnect', 'UserController@googleDisconnect');
        // Route::get('googleAuthenticate', 'LoginController@googleAuthenticate');

        Route::get('users/profile/{id}', 'UserController@userProfile');
        Route::match(array('GET', 'POST'),'users/reviews', 'UserController@reviews')->name('user_reviews');
        Route::match(array('GET', 'POST'),'users/reviews_by_you', 'UserController@reviewsByYou')->name('user_reviews_by_you');
        Route::match(['get', 'post'], 'reviews/edit/{id}', 'UserController@editReviews');
        Route::match(['get', 'post'], 'reviews/details', 'UserController@reviewDetails');

        Route::match(array('GET', 'POST'),'properties', 'PropertyController@userProperties')->name('user_properties');
        //    Route::match(array('GET', 'POST'),'property/create', 'PropertyController@create');
        Route::get('property/create', 'PropertyController@create')->name('property.create');
        Route::post('property', 'PropertyController@store')->name('property.store');
       
        Route::get('property/own-type', 'PropertyController@propertyOwnType')->name('property.propertyOwnType');
        Route::get('property/confirm-own-type', 'PropertyController@confirmOwnType')->name('property.confirmOwnType');
        Route::get('property/create-unlisted-property', 'PropertyController@createUnlistedProperty')->name('property.createUnlistedProperty');
        Route::match(['get', 'post'], 'property/{id}/details/name', 'PropertyDetailController@detailsName')->name('property.details.name');
        Route::match(['get', 'post'], 'property/{id}/details/location', 'PropertyDetailController@detailsLocation')->name('property.details.location');
        Route::match(['get', 'post'], 'property/{id}/details/pin-location', 'PropertyDetailController@detailsPinLocation')->name('property.details.pinLocation');
        Route::match(['get', 'post'], 'property/{id}/details/property-details', 'PropertyDetailController@detailsPropertyDetails')->name('property.details.propertyDetails');
    	Route::match(['get', 'post'],'property/{id}/details/bedroom', 'PropertyDetailController@detailsBedroom')->name('property.details.bedroom');
        Route::match(['get', 'post'], 'property/{id}/details/amenities', 'PropertyDetailController@detailsAmenities')->name('property.details.amenities');
        Route::match(['get', 'post'], 'property/{id}/details/breakfast', 'PropertyDetailController@detailsBreakfast')->name('property.details.breakfast');
        Route::match(['get', 'post'], 'property/{id}/details/language', 'PropertyDetailController@detailsLanguage')->name('property.details.language');
        Route::match(['get', 'post'], 'property/{id}/details/rule', 'PropertyDetailController@detailsRule')->name('property.details.rule');
        Route::match(['get', 'post'], 'property/{id}/details/photo', 'PropertyDetailController@detailsPhoto')->name('property.details.photo');
        Route::match(['get', 'post'], 'property/{id}/details/photo-airbnb', 'PropertyDetailController@detailsPhotoAirBnb')->name('property.details.photoAirBnb');
        Route::match(['get', 'post'], 'property/{id}/details/payment-options', 'PropertyDetailController@detailsPaymentOptions')->name('property.details.paymentOptions');
        Route::match(['get', 'post'], 'property/{id}/details/price-per-night', 'PropertyDetailController@detailsPricePerNight')->name('property.details.pricePerNight');
        Route::match(['get', 'post'], 'property/{id}/details/rate-plans', 'PropertyDetailController@detailsRatePlans')->name('property.details.ratePlans');
        Route::match(['get', 'post'], 'property/{id}/details/availability', 'PropertyDetailController@detailsAvailability')->name('property.details.availability');
        Route::match(['get', 'post'], 'property/{id}/details/availability-date', 'PropertyDetailController@detailsAvailabilityDate')->name('property.details.availabilityDate');
        Route::match(['get', 'post'], 'property/{id}/details/legal-info', 'PropertyDetailController@detailsLegalInfo')->name('property.details.legalInfo');
        Route::match(['get', 'post'], 'property/{id}/details/finalize', 'PropertyDetailController@detailsFinalize')->name('property.details.finalize');

        Route::match(array('GET', 'POST'),'listing/{id}/photo-upload', 'PropertyController@photoUpload');
        Route::match(array('GET', 'POST'),'listing/{id}/photo-selectables', 'PropertyController@reloadImages');
        Route::match(array('GET', 'POST'),'listing/{id}/photo_message', 'PropertyController@photoMessage')->middleware(['checkUserRoutesPermissions']);
        Route::match(array('GET', 'POST'),'listing/{id}/photo_delete', 'PropertyController@photoDelete')->middleware(['checkUserRoutesPermissions']);

        Route::match(array('POST'),'listing/photo/make_default_photo', 'PropertyController@makeDefaultPhoto');

        Route::match(array('POST'),'listing/photo/make_photo_serial', 'PropertyController@makePhotoSerial');

        Route::match(array('GET', 'POST'),'listing/update_status', 'PropertyController@updateStatus');
        Route::match(array('GET', 'POST'),'listing/{id}/{step}', 'PropertyController@listing')->where(['id' => '[0-9]+','step' => 'basics|description|location|amenities|photos|pricing|calendar|details|booking']);
        Route::get('list-property', 'PropertyController@listProperty')->name('list-property');

        Route::post('ajax-calender/{id}', 'CalendarController@calenderJson');
        Route::post('ajax-calender-price/{id}', 'CalendarController@calenderPriceSet');
        //iCalendar routes start
        Route::post('ajax-icalender-import/{id}', 'CalendarController@icalendarImport');
        Route::get('icalendar/synchronization/{id}', 'CalendarController@icalendarSynchronization');

        //iCalendar routes end
        Route::post('currency-symbol', 'PropertyController@currencySymbol');
        Route::match(['get', 'post'], 'payments/book/{id?}', 'PaymentController@index');
        Route::post('payments/create_booking', 'PaymentController@createBooking');
        Route::get('payments/success', 'PaymentController@success');
        Route::get('payments/cancel', 'PaymentController@cancel');
        Route::get('payments/stripe', 'PaymentController@stripePayment');
        Route::post('payments/stripe-request', 'PaymentController@stripeRequest');
        Route::get('booking/{id}', 'BookingController@index')->where('id', '[0-9]+');
        Route::get('booking_payment/{id}', 'BookingController@requestPayment')->where('id', '[0-9]+');
        Route::get('booking/requested', 'BookingController@requested');
        Route::get('booking/itinerary_friends', 'BookingController@requested');
        Route::post('booking/accept/{id}', 'BookingController@accept');
        Route::post('booking/decline/{id}', 'BookingController@decline');
        Route::get('booking/expire/{id}', 'BookingController@expire');
        Route::match(['get', 'post'], 'my-bookings', 'BookingController@myBookings')->name('user_bookings');
        Route::post('booking/host_cancel', 'BookingController@hostCancel');
        Route::match(['get', 'post'], 'trips/active', 'TripsController@myTrips')->name('user_trips');
        Route::get('booking/receipt', 'TripsController@receipt');
        Route::post('trips/guest_cancel', 'TripsController@guestCancel');

        // Messaging
        Route::match(['get', 'post'], 'inbox', 'InboxController@index')->name('user_inbox');
        Route::post('messaging/booking/', 'InboxController@message');
        Route::post('messaging/reply/', 'InboxController@messageReply');

        Route::match(['get', 'post'], 'users/account-preferences', 'UserController@accountPreferences');
        Route::get('users/account_delete/{id}', 'UserController@accountDelete');
        Route::get('users/account_default/{id}', 'UserController@accountDefault');
        Route::get('users/transaction-history', 'UserController@transactionHistory')->name('user_transaction_history');
        Route::post('users/account_transaction_history', 'UserController@getCompletedTransaction');

        Route::match(['GET', 'POST'], 'users/rewards', 'RewardsController@index')->name('user_rewards');

        // for customer payout settings
        Route::match(['GET', 'POST'], 'users/payout', 'PayoutController@index');
        Route::match(['GET', 'POST'], 'users/payout/setting', 'PayoutController@setting');
        Route::match(['GET', 'POST'], 'users/payout/edit-payout/', 'PayoutController@edit');
        Route::match(['GET', 'POST'], 'users/payout/delete-payout/{id}', 'PayoutController@delete');

        // for payout request
        Route::match(['GET', 'POST'], 'users/payout-list', 'PayoutController@payoutList')->name('user_payouts');
        Route::match(['GET', 'POST'], 'users/payout/success', 'PayoutController@success');

        Route::match(['get', 'post'], 'users/security', 'UserController@security');

        Route::post('visitors','VisitorController@store')->name('visitors.store');
        Route::get('logout', function()
        {
            Auth::logout();
            return Redirect::to('login');
        });
    });

    //for exporting iCalendar
    Route::get('icalender/export/{id}', 'CalendarController@icalendarExport');
    Route::post('admin/authenticate', 'Admin\AdminController@authenticate');
    //TODO::Next line of route is totally wrong,
    // you should not use this the first field as the url parameter
    //every route that will have single name will be captured by this route and redirected to this endpoint
    //suggestion use something like: 'icalender/{name}' or what is this module, that's name followed by the params

    Route::get('{name}', 'HomeController@staticPages');
    Route::post('duplicate-phone-number-check', 'UserController@duplicatePhoneNumberCheck');
    Route::post('duplicate-phone-number-check-for-existing-customer', 'UserController@duplicatePhoneNumberCheckForExistingCustomer');
    Route::match(['GET', 'POST'], 'admin/settings/sms', 'Admin\SettingsController@smsSettings');
    Route::match(['get', 'post'],'upload_image','Admin\PagesController@uploadImage')->name('upload');
});


Route::group(['domain' => $partnerDomain], function() {
    Route::group(['prefix' => 'partner', 'namespace' => 'Partner', 'middleware' => ['guest:partner']], function(){
        Route::get('dashboard/{property?}', 'DashboardController@index')->name('partner.property.dashboard');

        Route::get('rates-availability/{property?}', 'RatesAvailabiityController@index');
        
        Route::post('properties-calendar-days', 'DashboardController@calendarOutlook');
        Route::post('properties-reservation', 'DashboardController@propertiesReservation');
        Route::post('properties-today-activity', 'DashboardController@todayActivity');
        Route::post('reservations/table', 'DashboardController@tableReservationList');
        Route::get('reservations/{property?}', 'DashboardController@ReservationList');
        //Route::get('settings', 'SettingsController@index')->name('settings');
        
        Route::match(array('GET', 'POST'),'/bookings/new/{property?}', 'BookingsController@new')->name('partner.bookings.new');
        Route::match(array('GET', 'POST'),'/bookings/{id}/save/{step}', 'BookingsController@save')->name('partner.bookings.save');
    


        Route::get('settings/photos', 'SettingsController@photos')->name('photos');
        Route::get('settings/property/listings/{property?}', 'PropertyController@listings')->name('partner.only.property.listings');
        Route::get('settings/property/{property?}/layout', 'PropertyController@layout')->name('layout');
        Route::match(['GET', 'POST'], 'settings/property/create-new-property', 'PropertyController@createNewProperty')->name('create-new-property');
        Route::match(['GET', 'POST'], 'settings/property/create-new-property-diff-address', 'PropertyController@createNewPropertyWithDiffAddres')->name('create-new-property-diff-address');
        Route::match(['GET', 'POST'], 'settings/property/{property}/edit-layout/{id}', 'PropertyController@editLayout')->name('edit-property-layout');

        Route::get('calendar/{property?}', 'CalendarController@index')->name('calendar');
        Route::match(['GET', 'POST'], 'settings/amenities',  'AmenitiesController@index')->name('amenities');
        Route::get('reviews/{property?}', 'ReviewsController@index');
        Route::match(['GET', 'POST'], 'settings/facilities', 'FacilitiesController@index')->name('facilities');
        Route::get('inbox/{property?}', 'MessageController@index')->name('partner.inbox');
        Route::post('inbox/details/{booking_id}', 'MessageController@getMessageDetails')->name('partner.inbox.messageDetails');
        Route::post('inbox/new-message', 'MessageController@storeNewMessage')->name('partner.inbox.storeNewMessage');
        include('api/calendar.php');
    });
    Route::match(array('GET', 'POST'),'listing/{id}/photo-upload', 'PropertyController@photoUpload');
    Route::match(array('GET', 'POST'),'listing/{id}/photo-selectables', 'PropertyController@reloadImages');
    Route::match(array('GET', 'POST'),'listing/{id}/photo_message', 'PropertyController@photoMessage')->middleware(['checkUserRoutesPermissions']);
    Route::match(array('GET', 'POST'),'listing/{id}/photo_delete', 'PropertyController@photoDelete')->middleware(['checkUserRoutesPermissions']);

    Route::match(array('POST'),'listing/photo/make_default_photo', 'PropertyController@makeDefaultPhoto');
    
  // Partner
    Route::get('property/vacation-home', 'PropertyController@vacationHome')->name('partner.property.vacationHome');
    Route::get('property/confirm-vacation-type', 'PropertyController@confirmVacationType')->name('partner.property.confirmVationType');
    Route::get('property/own-type', 'PropertyController@propertyOwnType')->name('partner.property.propertyOwnType');
    Route::get('property/confirm-own-type', 'PropertyController@confirmOwnType')->name('partner.property.confirmOwnType');
    Route::get('property/create-unlisted-property', 'PropertyController@createUnlistedProperty')->name('partner.property.createUnlistedProperty');
    Route::match(['get', 'post'], 'property/{id}/details/name', 'PropertyDetailController@detailsName')->name('partner.property.details.name');
    Route::match(['get', 'post'], 'property/{id}/details/location', 'PropertyDetailController@detailsLocation')->name('partner.property.details.location');
    Route::match(['get', 'post'], 'property/{id}/details/pin-location', 'PropertyDetailController@detailsPinLocation')->name('partner.property.details.pinLocation');
    Route::match(['get', 'post'], 'property/{id}/details/property-details', 'PropertyDetailController@detailsPropertyDetails')->name('partner.property.details.propertyDetails');
    Route::match(['get', 'post'],'property/{id}/details/bedroom', 'PropertyDetailController@detailsBedroom')->name('partner.property.details.bedroom');
    Route::match(['get', 'post'], 'property/{id}/details/amenities', 'PropertyDetailController@detailsAmenities')->name('partner.property.details.amenities');
    Route::match(['get', 'post'], 'property/{id}/details/breakfast', 'PropertyDetailController@detailsBreakfast')->name('partner.property.details.breakfast');
    Route::match(['get', 'post'], 'property/{id}/details/language', 'PropertyDetailController@detailsLanguage')->name('partner.property.details.language');
    Route::match(['get', 'post'], 'property/{id}/details/rule', 'PropertyDetailController@detailsRule')->name('partner.property.details.rule');
    Route::match(['get', 'post'], 'property/{id}/details/photo', 'PropertyDetailController@detailsPhoto')->name('partner.property.details.photo');
    Route::match(['get', 'post'], 'property/{id}/details/photo-airbnb', 'PropertyDetailController@detailsPhotoAirBnb')->name('partner.property.details.photoAirBnb');
    Route::match(['get', 'post'], 'property/{id}/details/payment-options', 'PropertyDetailController@detailsPaymentOptions')->name('partner.property.details.paymentOptions');
    Route::match(['get', 'post'], 'property/{id}/details/price-per-night', 'PropertyDetailController@detailsPricePerNight')->name('partner.property.details.pricePerNight');
    Route::match(['get', 'post'], 'property/{id}/details/rate-plans', 'PropertyDetailController@detailsRatePlans')->name('partner.property.details.ratePlans');
    Route::match(['get', 'post'], 'property/{id}/details/availability', 'PropertyDetailController@detailsAvailability')->name('partner.property.details.availability');
    Route::match(['get', 'post'], 'property/{id}/details/availability-date', 'PropertyDetailController@detailsAvailabilityDate')->name('partner.property.details.availabilityDate');
    Route::match(['get', 'post'], 'property/{id}/details/legal-info', 'PropertyDetailController@detailsLegalInfo')->name('partner.property.details.legalInfo');
    Route::match(['get', 'post'], 'property/{id}/details/finalize', 'PropertyDetailController@detailsFinalize')->name('partner.property.details.finalize');


    Route::match(array('GET', 'POST'),'create-account', 'RegisterController@createAccount')->name('partner.create-account');
    Route::match(array('GET', 'POST'),'contact-details', 'RegisterController@contactDetails')->name('partner.contact-details');
    Route::match(array('GET', 'POST'),'create-password', 'RegisterController@createPassword')->name('partner.create-password');


    Route::match(array('POST'),'listing/photo/make_photo_serial', 'PropertyController@makePhotoSerial');
    
    Route::group(['prefix' => '', 'namespace' => 'Partner'], function(){
        Route::get('/', 'PartnerController@index');
        Route::get('login', 'PartnerController@index');
        Route::post('authenticate', 'PartnerController@authenticate');
        Route::match(array('GET', 'POST'),'/photo-upload', 'PartnerController@photoUpload');
        Route::match(array('GET', 'POST'),'/file-upload', 'PartnerController@fileUpload')->name('property.show');
    });

    Route::get('logout', function() {
        Auth::logout();
        return Redirect::to('login');
    });
    Route::match(array('GET', 'POST'),'listing/{id}/{step}', 'PropertyController@listing')->where(['id' => '[0-9]+','page' => 'calendar']);
    Route::match(array('GET', 'POST'),'properties', 'PropertyController@userProperties');

    Route::get('list-property', 'PropertyController@listProperty')->name('partner.list-property');
});
//For Partner

Route::post('ajax-calender/{id}', 'CalendarController@calenderJson');
Route::post('ajax-calender-price/{id}', 'CalendarController@calenderPriceSet');
//iCalendar routes start
Route::post('ajax-icalender-import/{id}', 'CalendarController@icalendarImport');
Route::get('icalendar/synchronization/{id}', 'CalendarController@icalendarSynchronization');

Route::get('list-apartment','PropertyController@apartmentdetails');

Route::post('apartment','PropertyController@singleapartment');

Route::get('property-name','PropertyController@propertyname');

Route::post('property-name','PropertyController@propertyname');

Route::match(array('GET', 'POST'),'list/{id}/{step}','PropertyController@propertylisting')->where(['id' => '[0-9]+','page' => 'location|basics|amenities|breakfast|language|check-ins|photos|credit-card|pricing|booking|licencing|review']);

Route::post('property-address','PropertyController@propertyaddress');

Route::get('property-location','PropertyController@propertylocation');

Route::match(array('GET', 'POST'),'properties/{slug}', 'PropertyController@single')->name('property.show');

Route::get('users/show/{id}', 'UserController@show');

Route::get('/boats/register','BoatsController@new');
Route::get('/boats/{id}/edit','BoatsController@edit');


