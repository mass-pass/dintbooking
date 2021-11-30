<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PricingInterval extends Model
{
    protected $table   = 'pricing_intervals';
    protected $appends = ['interval_days_as_string'];

    public const ATTRIBUTES = ['property_layout_id',
        'name','start_date','end_date','min_los', 'max_los', 'closed_arrivals', 'closed_departure',
        'extra_charges_additional_guest','charges_sunday','charges_monday','charges_tuesday','charges_wednesday',
        'charges_thursday', 'charges_friday','charges_saturday'
    ];

    public function property_layout()
    {
        return $this->belongsTo('App\Models\PropertyLayout', 'property_layout_id', 'id');
    }

    public function scopeForDateRange($q, $start, $end){
        return $q->where('start_date', '>=', $start);
    }



    public function getIntervalDaysAsStringAttribute(){
        $days = [];
        if($this->charges_sunday > 0){
            $days[] = 'Sun';
        }
        if($this->charges_monday > 0){
            $days[] = 'Mon';
        }
        if($this->charges_tuesday > 0){
            $days[] = 'Tue';
        }
        if($this->charges_wednesday > 0){
            $days[] = 'Wed';
        }
        if($this->charges_thursday > 0){
            $days[] = 'Thu';
        }
        if($this->charges_friday > 0){
            $days[] = 'Fri';
        }
        if($this->charges_satday > 0){
            $days[] = 'Sat';
        }

        return join(' ', $days);

    }

}
