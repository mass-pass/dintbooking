<?php


namespace App\Helpers;


use App\Models\Visitor;

class VisitorHelper
{
    public static function storeVisitor($userInfo)
    {
        return Visitor::firstOrCreate(
            [
                'ip'                    => $userInfo['ip'],
            ],
            [
                'country_code'          => $userInfo['country_code']??"",
                'city'                  => $userInfo['city']??"",
                'country_name'          => $userInfo['country_name']??"",
                'zip_code'              => $userInfo['zip_code']??"",
                'created_at'            => now(),
                'updated_at'            => now(),
            ]
        );
    }
    public static function storeSearch($visitorInfo, $location)
    {
        $userInfo = json_decode($visitorInfo,true);
        $visitor = self::storeVisitor($userInfo);
        \DB::table('visitor_searches')->insertOrIgnore(
            [
                'visitor_id'        => $visitor->id,
                'location'          => $location,
                'created_at'        => now(),
                'updated_at'        => now()
            ]
        );
    }
}