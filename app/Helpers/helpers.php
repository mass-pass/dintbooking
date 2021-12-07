<?php

use App\Models\Settings;
use App\Models\Change;
use App\Models\Currency;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Session;
use App\Http\Helpers\Common;
use Twilio\Http\CurlClient;
use App\Models\Language;
use App\Models\Photo;

function getLanguages() {
    $languages = [];
    foreach(Language::where('status', 1)->get() as $each) {
        $languages[$each->short_name] = $each->name;
    }
    return $languages;
}

function getCurrencies() {
    return Currency::where('status', '=', 'Active')->select('code', 'name', 'symbol')->get();
}

function flagsShortcodes($name){
    $language = App\Models\Language::where('short_name', '=', $name)->first();
    if($language){
        return $language->short_name;
    }
    return 'en';
}

/**
 * [dateFormat description for database date]
 * @param  [type] $value    [any number]
 * @return [type] [formates date according to preferences setting in Admin Panel]
 */
function setDateForDb($value = null)
{
    if (empty($value)) {
        return null;
    }
    $separator   = Session::get('date_separator');
    $date_format = Session::get('date_format_type');
    if (str_replace($separator, '', $date_format) == "mmddyyyy") {
        $value = str_replace($separator, '/', $value);
        $date  = date('Y-m-d', strtotime($value));
    } else {
        $date = date('Y-m-d', strtotime(strtr($value, $separator, '-')));
    }
    return $date;
}

function s3Url($photo, $photoable_id = false){
    $str = '';
    if(is_object($photo) && isset($photo->photoable_id)){
        $photoable_id = $photo->photoable_id;
        $photoable_type = $photo->photoable_type;
        $photo = $photo->photo;
    }else{
        $cover_photo = Photo::where('photoable_id', $photoable_id)->where('photo', $photo)->first();
        $photoable_type = $cover_photo['photoable_type'];
    }
    // $str.= rtrim(env('S3_BUCKET_PATH'), "/");
    if(env('S3_BUCKET_PATH') == '') {
        $str = '/storage/';
    } else {
        $str= env('S3_BUCKET_PATH');
    }
    $str= rtrim($str, "/");
    
    if($photoable_type == 'App\Models\Boat'){
        $str.='/images/boat/'.$photoable_id;
    }else{
        $str.='/images/property/'.$photoable_id;
    }
    $str.='/'.$photo;

    return $str;
}

function s3BoatUrl($photo, $photoable_id = false){
    $str = '';
    $cover_photo = Photo::where('photoable_id', $photoable_id)->where('photo', $photo)->first();
    $photoable_type = $cover_photo['photoable_type'];

    
    if($photoable_type == 'App\Models\Boat'){
        $str.='/images/boat/'.$photoable_id;
    }else{
        $str.='/images/property/'.$photoable_id;
    }
    $str.='/'.$photo;

    return $str;
}

function s3PropertyUrl($photo, $s3_path, $photoable_id = false) {
    $str = '';
    if(is_object($photo) && isset($photo->photoable_id)){
        $photoable_id = $photo->photoable_id;
        $photo = $photo->photo;
    }
    if($s3_path != ''){
        $str= rtrim($s3_path, "/");
    }else{
        // $str= rtrim(env('S3_BUCKET_PATH'), "/");
        if(env('S3_BUCKET_PATH') == '') {
            $str = '/storage/';
        } else {
            $str= env('S3_BUCKET_PATH');
        }
        $str= rtrim($str, "/");
    }
    $str.='/images/property/'.$photoable_id;
    $str.='/'.$photo;
    return $str;
}

function replaceBracket($name){
    $name = str_replace('(', '_', $name);
    $name = str_replace(')', '_', $name);
    return $name;
}

function s3UrlAppend($url){
    $str = '';
    
    if(env('S3_BUCKET_PATH') == '') {
        $str = '/storage/';
    } else {
        $str= env('S3_BUCKET_PATH');
    }
    $str= rtrim($str, "/");
    $str.="/".(ltrim($url,"/"));

    return $str;
}


/**
 * [Default timezones]
 * @return [timezonesArray]
 */
function phpDefaultTimeZones()
{
    $zonesArray  = array();
    $timestamp   = time();
    foreach (timezone_identifiers_list() as $key => $zone) {
        date_default_timezone_set($zone);
        $zonesArray[$key]['zone']          = $zone;
        $zonesArray[$key]['diff_from_GMT'] = 'UTC/GMT ' . date('P', $timestamp);
    }
    return $zonesArray;
    // return $timezones;
}


/**
 * [dateFormat description]
 * @param  [type] $value    [any number]
 * @return [type] [formates date according to preferences setting in Admin Panel]
 */
function dateFormat($value, $type = null)
{
    $timezone       = '';
    $timezone       = Settings::where(['type' => 'preferences', 'name' => 'dflt_timezone'])->first(['value'])->value;
    $today          = new DateTime($value, new DateTimeZone(config('app.timezone')));
    $today->setTimezone(new DateTimeZone($timezone));
    $value          = $today->format('Y-m-d H:i:s');


    $preferenceData = Settings::where(['type' => 'preferences'])->whereIn('name', ['date_format_type', 'date_separator'])->get(['name', 'value'])->toArray();
    $preferenceData = Common::key_value('name', 'value', $preferenceData);
    $preference     = $preferenceData['date_format_type'];
    $separator      = $preferenceData['date_separator'];

    $data           = str_replace(['/', '.', ' ', '-'], $separator, $preference);
    $data           = explode($separator, $data);
    $first          = $data[0];
    $second         = $data[1];
    $third          = $data[2];

    $dateInfo       = str_replace(['/', '.', ' ', '-'], $separator, $value);
    $datas          = explode($separator, $dateInfo);
    $year           = $datas[0];
    $month          = $datas[1];
    $day            = $datas[2];

    $dateObj        = DateTime::createFromFormat('!m', $month);
    $monthName      = $dateObj->format('F');

    $toHoursMin     = \Carbon\Carbon::createFromTimeStamp(strtotime($value))->format(' g:i A');

    if ($first == 'yyyy' && $second == 'mm' && $third == 'dd') {
        $value = $year . $separator . $month . $separator . $day. $toHoursMin;
    } else if ($first == 'dd' && $second == 'mm' && $third == 'yyyy') {
        $value = $day . $separator . $month . $separator . $year. $toHoursMin;
    } else if ($first == 'mm' && $second == 'dd' && $third == 'yyyy') {
        $value = $month . $separator . $day . $separator . $year. $toHoursMin;
    } else if ($first == 'dd' && $second == 'M' && $third == 'yyyy') {
        $value = $day . $separator . $monthName . $separator . $year. $toHoursMin;
    } else if ($first == 'yyyy' && $second == 'M' && $third == 'dd') {
        $value = $year . $separator . $monthName . $separator . $day. $toHoursMin;
    }        
    return $value;

}


/**
* Process of sending twilio message 
*
* @param string $request
*
* @return mixed
*/
function twilioSendSms($toNumber,$messages)
{
        
    try {

        $client          = new CurlClient();
        $response        = $client->request('GET', 'https://api.twilio.com:8443');
        $phoneSms        = Settings::where('type','twilio')->whereIn('name', ['twilio_sid', 'twilio_token','formatted_phone'])->pluck('value', 'name')->toArray();    
        $sid             = !empty($phoneSms['twilio_sid']) ? $phoneSms['twilio_sid'] : 'ACf4fd1e';
        $token           = !empty($phoneSms['twilio_token']) ? $phoneSms['twilio_token'] : 'da9580307';

        $url             = "https://api.twilio.com/2010-04-01/Accounts/$sid/SMS/Messages";
        $trimmedMsg      = trim(preg_replace('/\s\s+/', ' ', $messages));

        if (!empty($phoneSms['formatted_phone'])) {
            $data = array (
                'From' => $phoneSms['formatted_phone'],
                'To' => $toNumber,
                'Body' => strip_tags($trimmedMsg),
            );
            $post = http_build_query($data);
            $x    = curl_init($url );
            curl_setopt($x, CURLOPT_POST, true);
            curl_setopt($x, CURLOPT_RETURNTRANSFER, true);
            if ($response->getStatusCode() <= 200 || $response->getStatusCode() >= 300) {
                curl_setopt($x, CURLOPT_SSL_VERIFYHOST, false);
                curl_setopt($x, CURLOPT_SSL_VERIFYPEER, false);
            }
            curl_setopt($x, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
            curl_setopt($x, CURLOPT_USERPWD, "$sid:$token");
            curl_setopt($x, CURLOPT_POSTFIELDS, $post);
            $y = curl_exec($x);
            curl_close($x);
        }
        return redirect()->back();   
           
    } catch (Exception $e) {

        return redirect()->back();        
    }   
                 
}

/**
 * [onlyFormat description]
 * @param  [type] $value    [any number]
 * @return [type] [formates date according to preferences setting in Admin Panel]
 */
function onlyFormat($value)
{
    $preferenceData = Settings::where(['type' => 'preferences'])->whereIn('name', ['date_format_type', 'date_separator'])->get(['name', 'value'])->toArray();
    $preferenceData = Common::key_value('name', 'value', $preferenceData);
    $separator      = $preferenceData['date_separator'];
    $preference     = str_replace(['/', '.', ' ', '-'], '', $preferenceData['date_format_type']);
    switch ($preference) {
        case 'yyyymmdd':
            $value = date('yy'. $separator . 'm' . $separator . 'd', strtotime($value));
            break;
        case 'ddmmyyyy':
            $value = date('d' . $separator .'m' . $separator . 'yy', strtotime($value));
            break;
        case 'mmddyyyy':
            $value = date('m' . $separator . 'd' . $separator . 'yy', strtotime($value));
            break;
        case 'ddMyyyy':
            $value = date('d' . $separator .'M' . $separator . 'yy', strtotime($value));
            break;
        case 'yyyyMdd':
            $value = date('yy' . $separator . 'M' . $separator . 'd', strtotime($value));
            break;
        default:
            $value = date('yy-m-d', strtotime($value));
            break;
    }
    return $value;

}

/**
 * [roundFormat description]
 * @param  [type] $value     [any number]
 * @return [type] [placement of money symbol according to preferences setting in Admin Panel]
 */
function moneyFormat($symbol, $value)
{
    $symbolPosition = currencySymbolPosition();
    if ($symbolPosition == "before") {
         $value = $symbol . ' ' . $value;
    } else {
        $value = $value . ' ' . $symbol;
    }
    return $value;
}

/**
 * [currencySymbolPosition description]
 * @return [position type of symbol after or before]
 */
function currencySymbolPosition() 
{
    $position = Settings::where(['type' => 'preferences', 'name' => 'money_format'])->first(['value'])->value;
    return !empty($position) ? $position : 'after';
}


 function codeToSymbol($code)
{
    $symbol = DB::table('currency')->where('code', $code)->first()->symbol;
    return $symbol;
}

function changeEnvironmentVariable($key, $value)
{
    $path = base_path('.env');

    if (is_bool(env($key)))
    {
        $old = env($key) ? 'true' : 'false';
    }
    elseif (env($key) === null)
    {
        $old = 'null';
    }
    else
    {
        $old = env($key);
    }

    if (file_exists($path))
    {
        if ($old == 'null')
        {

            file_put_contents($path, "$key=" . $value, FILE_APPEND);
        }
        else
        {
            file_put_contents($path, str_replace(
                "$key=" . $old, "$key=" . $value, file_get_contents($path)
            ));
        }
    }
}


function getLanguageNameFromCode($code){
    $list = getLanguagesList();
    return isset($list[$code])?$list[$code]:$code;
}

function getLanguagesList(){
    $languages = [];
        $languages["aa"] = "Afar";
        $languages["ab"] = "Abkhazian";
        $languages["ae"] = "Avestan";
        $languages["af"] = "Afrikaans";
        $languages["ak"] = "Akan";
        $languages["am"] = "Amharic";
        $languages["an"] = "Aragonese";
        $languages["ar"] = "Arabic";
        $languages["as"] = "Assamese";
        $languages["av"] = "Avaric";
        $languages["ay"] = "Aymara";
        $languages["az"] = "Azerbaijani";
        $languages["ba"] = "Bashkir";
        $languages["be"] = "Belarusian";
        $languages["bg"] = "Bulgarian";
        $languages["bh"] = "Bihari languages";
        $languages["bi"] = "Bislama";
        $languages["bm"] = "Bambara";
        $languages["bn"] = "Bengali";
        $languages["bo"] = "Tibetan";
        $languages["br"] = "Breton";
        $languages["bs"] = "Bosnian";
        $languages["ca"] = "Catalan; Valencian";
        $languages["ce"] = "Chechen";
        $languages["ch"] = "Chamorro";
        $languages["co"] = "Corsican";
        $languages["cr"] = "Cree";
        $languages["cs"] = "Czech";
        $languages["cv"] = "Chuvash";
        $languages["cy"] = "Welsh";
        $languages["da"] = "Danish";
        $languages["de"] = "German";
        $languages["dv"] = "Divehi; Dhivehi; Maldivian";
        $languages["dz"] = "Dzongkha";
        $languages["ee"] = "Ewe";
        $languages["el"] = "Greek, Modern (1453-)";
        $languages["en"] = "English";
        $languages["eo"] = "Esperanto";
        $languages["es"] = "Spanish; Castilian";
        $languages["et"] = "Estonian";
        $languages["eu"] = "Basque";
        $languages["fa"] = "Persian";
        $languages["ff"] = "Fulah";
        $languages["fi"] = "Finnish";
        $languages["fj"] = "Fijian";
        $languages["fo"] = "Faroese";
        $languages["fr"] = "French";
        $languages["fy"] = "Western Frisian";
        $languages["ga"] = "Irish";
        $languages["gd"] = "Gaelic; Scomttish Gaelic";
        $languages["gl"] = "Galician";
        $languages["gn"] = "Guarani";
        $languages["gu"] = "Gujarati";
        $languages["gv"] = "Manx";
        $languages["ha"] = "Hausa";
        $languages["he"] = "Hebrew";
        $languages["hi"] = "Hindi";
        $languages["ho"] = "Hiri Motu";
        $languages["hr"] = "Croatian";
        $languages["ht"] = "Haitian; Haitian Creole";
        $languages["hu"] = "Hungarian";
        $languages["hy"] = "Armenian";
        $languages["hz"] = "Herero";
        $languages["id"] = "Indonesian";
        $languages["ie"] = "Interlingue; Occidental";
        $languages["ig"] = "Igbo";
        $languages["ii"] = "Sichuan Yi; Nuosu";
        $languages["ik"] = "Inupiaq";
        $languages["io"] = "Ido";
        $languages["is"] = "Icelandic";
        $languages["it"] = "Italian";
        $languages["iu"] = "Inuktitut";
        $languages["ja"] = "Japanese";
        $languages["jv"] = "Javanese";
        $languages["ka"] = "Georgian";
        $languages["kg"] = "Kongo";
        $languages["ki"] = "Kikuyu; Gikuyu";
        $languages["kj"] = "Kuanyama; Kwanyama";
        $languages["kk"] = "Kazakh";
        $languages["kl"] = "Kalaallisut; Greenlandic";
        $languages["km"] = "Central Khmer";
        $languages["kn"] = "Kannada";
        $languages["ko"] = "Korean";
        $languages["kr"] = "Kanuri";
        $languages["ks"] = "Kashmiri";
        $languages["ku"] = "Kurdish";
        $languages["kv"] = "Komi";
        $languages["kw"] = "Cornish";
        $languages["ky"] = "Kirghiz; Kyrgyz";
        $languages["la"] = "Latin";
        $languages["lb"] = "Luxembourgish; Letzeburgesch";
        $languages["lg"] = "Ganda";
        $languages["li"] = "Limburgan; Limburger; Limburgish";
        $languages["ln"] = "Lingala";
        $languages["lo"] = "Lao";
        $languages["lt"] = "Lithuanian";
        $languages["lu"] = "Luba-Katanga";
        $languages["lv"] = "Latvian";
        $languages["mg"] = "Malagasy";
        $languages["mh"] = "Marshallese";
        $languages["mi"] = "Maori";
        $languages["mk"] = "Macedonian";
        $languages["ml"] = "Malayalam";
        $languages["mn"] = "Mongolian";
        $languages["mr"] = "Marathi";
        $languages["ms"] = "Malay";
        $languages["mt"] = "Maltese";
        $languages["my"] = "Burmese";
        $languages["na"] = "Nauru";
        $languages["nd"] = "Ndebele, North; North Ndebele";
        $languages["ne"] = "Nepali";
        $languages["ng"] = "Ndonga";
        $languages["nl"] = "Dutch; Flemish";
        $languages["nn"] = "Norwegian Nynorsk; Nynorsk, Norwegian";
        $languages["no"] = "Norwegian";
        $languages["nr"] = "Ndebele, South; South Ndebele";
        $languages["nv"] = "Navajo; Navaho";
        $languages["ny"] = "Chichewa; Chewa; Nyanja";
        $languages["oc"] = "Occitan (post 1500)";
        $languages["oj"] = "Ojibwa";
        $languages["om"] = "Oromo";
        $languages["or"] = "Oriya";
        $languages["os"] = "Ossetian; Ossetic";
        $languages["pa"] = "Panjabi; Punjabi";
        $languages["pi"] = "Pali";
        $languages["pl"] = "Polish";
        $languages["ps"] = "Pushto; Pashto";
        $languages["pt"] = "Portuguese";
        $languages["qu"] = "Quechua";
        $languages["rm"] = "Romansh";
        $languages["rn"] = "Rundi";
        $languages["ro"] = "Romanian; Moldavian; Moldovan";
        $languages["ru"] = "Russian";
        $languages["rw"] = "Kinyarwanda";
        $languages["sa"] = "Sanskrit";
        $languages["sc"] = "Sardinian";
        $languages["sd"] = "Sindhi";
        $languages["se"] = "Northern Sami";
        $languages["sg"] = "Sango";
        $languages["si"] = "Sinhala; Sinhalese";
        $languages["sk"] = "Slovak";
        $languages["sl"] = "Slovenian";
        $languages["sm"] = "Samoan";
        $languages["sn"] = "Shona";
        $languages["so"] = "Somali";
        $languages["sq"] = "Albanian";
        $languages["sr"] = "Serbian";
        $languages["ss"] = "Swati";
        $languages["st"] = "Sotho, Southern";
        $languages["su"] = "Sundanese";
        $languages["sv"] = "Swedish";
        $languages["sw"] = "Swahili";
        $languages["ta"] = "Tamil";
        $languages["te"] = "Telugu";
        $languages["tg"] = "Tajik";
        $languages["th"] = "Thai";
        $languages["ti"] = "Tigrinya";
        $languages["tk"] = "Turkmen";
        $languages["tl"] = "Tagalog";
        $languages["tn"] = "Tswana";
        $languages["to"] = "Tonga (Tonga Islands)";
        $languages["tr"] = "Turkish";
        $languages["ts"] = "Tsonga";
        $languages["tt"] = "Tatar";
        $languages["tw"] = "Twi";
        $languages["ty"] = "Tahitian";
        $languages["ug"] = "Uighur; Uyghur";
        $languages["uk"] = "Ukrainian";
        $languages["ur"] = "Urdu";
        $languages["uz"] = "Uzbek";
        $languages["ve"] = "Venda";
        $languages["vi"] = "Vietnamese";
        $languages["vo"] = "Volapük";
        $languages["wa"] = "Walloon";
        $languages["wo"] = "Wolof";
        $languages["xh"] = "Xhosa";
        $languages["yi"] = "Yiddish";
        $languages["yo"] = "Yoruba";
        $languages["za"] = "Zhuang; Chuang";
        $languages["zh"] = "Chinese";
        $languages["zu"] = "Zulu" ;
return $languages;

if($language == 'null'){
    $languages["zu"] = "Zulu" ;
}

}

function selectPropertyFirst() {
    return redirect()->route('partner.only.property.listings');
}

function setCurrentPropertyIdInSession($id)
{
    session(['currentPropertyId' =>  $id]); 
}

function getCurrentPropertyIdInSession() {
    return session('currentPropertyId', null);
}