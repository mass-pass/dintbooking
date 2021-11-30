<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Price;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
class PropertyLayout extends Model
{
    protected $table   = 'property_layouts';

    const PRICING_CLEANING_FEE = 'cleaning_fee';
    const PRICING_GUEST_AFTER = 'guest_after';
    const PRICING_GUEST_FEE = 'guest_fee';
    const PRICING_SECURITY_FEE = 'security_fee';
    const PRICING_PRICE = 'price';
    const PRICING_WEEKEND_PRICE = 'weekend_price';
    const PRICING_WEEKLY_DISCOUNT = 'weekly_discount';
    const PRICING_MONTHLY_DISCOUNT = 'monthly_discount';
    protected $casts = [
        'beds' => 'array',
        'bathrooms' => 'array',
        'pricing' => 'array',
    ];

    public function property()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }

    public function pricing_intervals(){
        return $this->hasMany('App\Models\PricingInterval');
    }



    public function prices(){
        return $this->morphMany(Price::class, 'priceable');
    }

    public function getCleaningFeeAttribute(){
        return $this->prices()->byCategory(self::PRICING_CLEANING_FEE)->first();
    }

    public function setCleaningFeeAttribute($data){
        $data['category'] = self::PRICING_CLEANING_FEE;
        $this->newPrice($data);
    }

    public function getGuestAfterFeeAttribute(){
        return $this->prices()->byCategory(self::PRICING_GUEST_AFTER)->first();
    }

    public function setGuestAfterFeeAttribute($data){
        $data['category'] = self::PRICING_GUEST_AFTER;
        $this->newPrice($data);
    }

    public function getGuestFeeAttribute(){
        return $this->prices()->byCategory(self::PRICING_GUEST_FEE)->first();
    }

    public function setGuestFeeAttribute($data){
        $data['category'] = self::PRICING_GUEST_FEE;
        $this->newPrice($data);
    }

    public function getSecurityFeeAttribute(){
        return $this->prices()->byCategory(self::PRICING_SECURITY_FEE)->first();
    }

    public function setSecurityFeeAttribute($data){
        $data['category'] = self::PRICING_SECURITY_FEE;
        $this->newPrice($data);
    }

    public function getPriceAttribute(){
        return $this->prices()->byCategory(self::PRICING_PRICE)->first();
    }

    public function setPriceAttribute($data){
        $data['category'] = self::PRICING_PRICE;
        $this->newPrice($data);
    }

    public function getWeekendPriceAttribute(){
        return $this->prices()->byCategory(self::PRICING_WEEKEND_PRICE)->first();
    }

    public function setWeekendPriceAttribute($data){
        $data['category'] = self::PRICING_WEEKEND_PRICE;
        $this->newPrice($data);
    }

    public function getWeeklyDiscountAttribute(){
        return $this->prices()->byCategory(self::PRICING_WEEKLY_DISCOUNT)->first();
    }

    public function setWeeklyDiscountAttribute($data){
        $data['category'] = self::PRICING_WEEKLY_DISCOUNT;
        $this->newPrice($data);
    }

    public function getMonthlyDiscountAttribute(){
        return $this->prices()->byCategory(self::PRICING_MONTHLY_DISCOUNT)->first();
    }

    public function setMonthlyDiscountAttribute($data){
        $data['category'] = self::PRICING_MONTHLY_DISCOUNT;
        $this->newPrice($data);
    }

    public function property_units(){
        return $this->hasMany('\App\Models\PropertyUnit');
    }

    private function newPrice($data){
        $price = new \App\Models\Price();
        $price->priceable_type = '\App\Models\PropertyLayout';
        $price->priceable_id = $this->id;
        $price->category = $data['category'];
        $price->amount = $data['amount'];
        $price->comments = $data['comments'];
        $price->currency_code = $data['currency_code'];
        $price->save();

    }

    public function getPriceForDate($one_date){
        $fallback_price = $this->property->property_price ? $this->property->property_price->price:100;
        $pricing_interval = $this->pricing_intervals()->ForDate($one_date)->first();
        if(!$pricing_interval){
            return $fallback_price;
        }

    }

    /**
     * @method getPricingForDates: This function returns pricing for the given timeinterval for selected model.
     * 
     * @param $startDate : Start date
     * @param $startDate : End date
     * 
     * @return array
     */
    public function getPricingForDates($startDate, $endDate)
    {
        $pricing = [];
        $defaultFallbackPrices = $this->property->property_price ? $this->property->property_price->price : 100; // Need to manage this 100 from env
        $pricingIntervals = \App\Models\PricingInterval::where('property_layout_id', $this->id)
                                ->where('start_date', '>=', $startDate)
                                ->where('end_date', '<=', $endDate)
                                ->orderby('start_date', 'asc')->get();
        $from = Carbon::parse($startDate);
        $to = Carbon::parse($endDate);
        $period = CarbonPeriod::create($from, $to);
        foreach ($period as $date) {
            $filter = $pricingIntervals->filter(function ($pricingInterval) use ($date) {
                $startDate = Carbon::parse($pricingInterval->start_date);
                $endDate = Carbon::parse($pricingInterval->end_date);
                $dateToCheck = Carbon::parse($date);

                return $dateToCheck->between($startDate, $endDate);
            });
            if (!isset($pricing[$date->format('F Y')])) {
                $pricing[$date->format('F Y')] = [];
            }
            if ($finalPricing = $filter->first()) {
                // It means there is a pricing interval set for this property layout.
                switch(strtolower($date->format('l'))){
                    case 'sunday':
                        $pricing[$date->format('F Y')][$date->format('Y-m-d')] = $finalPricing->charges_sunday;
                    break;
                    case 'monday':
                        $pricing[$date->format('F Y')][$date->format('Y-m-d')] = $finalPricing->charges_monday;
                    break;
                    case 'tuesday':
                        $pricing[$date->format('F Y')][$date->format('Y-m-d')] = $finalPricing->charges_tuesday;
                    break;
                    case 'wednesday':
                        $pricing[$date->format('F Y')][$date->format('Y-m-d')] = $finalPricing->charges_wednesday;
                    break;
                    case 'thursday':
                        $pricing[$date->format('F Y')][$date->format('Y-m-d')] = $finalPricing->charges_thursday;
                    break;
                    case 'friday':
                        $pricing[$date->format('F Y')][$date->format('Y-m-d')] = $finalPricing->charges_friday;
                    break;
                    case 'saturday':
                        $pricing[$date->format('F Y')][$date->format('Y-m-d')] = $finalPricing->charges_saturday;
                    break;
                }
            } else {
                // It means there is no pricing interval is set for this property layout. We need to set the default price.
                $pricing[$date->format('F Y')][$date->format('Y-m-d')] = $defaultFallbackPrices;
            }

        }

        return $pricing;
    }

}
