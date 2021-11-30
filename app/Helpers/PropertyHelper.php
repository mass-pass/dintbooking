<?php


namespace App\Helpers;


use App\Models\Properties;

class PropertyHelper
{
    /**
     * This function check if there is a property with the slug already available
     * if slug found just add the number at the end and again check for the case
     * if no slug found, current slug will be returned
     * @param $slug
     * @return mixed|string
     */
    public static function getUniqueSLug($slug, $property_id = 0)
    {
        $i = 1;
        //making use of temp slug and $slug
        // to preserve the actual slug value in $slug variable
        $temp_slug = $slug;
        do {
            //Check in the database here
            $exists = Properties::where('slug',$temp_slug)
                ->where('id','!=',$property_id)
                ->first();
            if($exists) {
                $i++;
                $temp_slug = $slug."-".$i;
            }
        }while($exists);
        return $temp_slug;
    }
}