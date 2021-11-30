<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Payouts;
use App\Models\Penalty;
use App\Models\Currency;
use App\Models\Accounts;
use Session;
use DateTime;

class Bookings extends Model
{
    protected $table = 'bookings';
    protected $dates = ['created_at','updated_at','deleted_at','start_date','end_date'];

    protected $appends = ['host_payout', 'label_color', 'date_range', 'expiration_time'];

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function host()
    {
        return $this->belongsTo('App\Models\User', 'host_id', 'id');
    }

    public function properties()
    {
        return $this->belongsTo('App\Models\Properties', 'property_id', 'id');
    }

    public function payment_methods()
    {
        return $this->belongsTo('App\Models\PaymentMethods', 'payment_method_id', 'id');
    }

    public function booking_details()
    {
        return $this->hasMany('App\Models\BookingDetails', 'booking_id', 'id');
    }

    public function penalty()
    {
        return $this->hasMany('App\Models\Penalty', 'booking_id', 'id');
    }

    public function payouts()
    {
        return $this->hasMany('App\Models\Payouts', 'booking_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Reviews', 'booking_id', 'id');
    }

    public function messages()
    {
        return $this->hasMany('App\Models\Messages', 'booking_id', 'id');
    }

    public function currency()
    {
        return $this->belongsTo('App\Models\Currency', 'currency_code', 'code');
    }

    public function scopeCheckInToday($q){
        return $q->where('start_date', '=', \Carbon\Carbon::today());
    }

    public function scopeCheckOutToday($q){
        return $q->where('end_date', '=', \Carbon\Carbon::today());
    }

    public function scopeCheckInTomorrow($q){
        return $q->where('start_date', '=', \Carbon\Carbon::tomorrow());
    }

    public function scopeCheckOutTomorrow($q){
        return $q->where('end_date', '=', \Carbon\Carbon::tomorrow());
    }

    public function scopeBetweenDateRange($q, $from, $to){
        return $q->where('start_date', '>=', $from)->where('end_date', '<=', $to);
    }

    public function scopeStartsWithinDateRange($q, $date){
        return $q->where('start_date', '>=', $date)->where('start_date', '<=', $to);
    }

    public function getHostPenaltyAmountAttribute()
    {
        $amount = Penalty::where('booking_id', $this->attributes['id'])->where('user_type', 'Host')->sum('amount');
        return $this->currency_convert($amount);
    }

    public function getGuestPenaltyAmountAttribute()
    {
        $amount = Penalty::where('booking_id', $this->attributes['id'])->where('user_type', 'Guest')->sum('amount');
        return $this->currency_convert($amount);
    }

    //Host/Guest original Payouts
    public function getOriginalHostPayoutAttribute()
    {
        $payout = Payouts::where('user_id', $this->attributes['host_id'])->where('booking_id', $this->attributes['id'])->first();
        if (isset($payout->original_amount)) {
            return $payout->original_amount;
        } else {
            return $this->attributes['total'] - $this->attributes['service_charge'] - $this->attributes['host_fee'];
        }
    }

    public function getOriginalGuestPayoutAttribute()
    {
        $payout = Payouts::where('user_id', $this->attributes['user_id'])->where('booking_id', $this->attributes['id'])->first();
        if (isset($payout->original_amount)) {
            return $payout->original_amount;
        } else {
            return $this->attributes['total'] - $this->attributes['service_charge'];
        }
    }

    //Host/Guest payout
    public function getHostPayoutAttribute()
    {
        $payout = Payouts::where('user_id', $this->attributes['host_id'])->where('booking_id', $this->attributes['id'])->first();
      
        if (isset($payout->amount)) {
            return $payout->amount;
        } else {
            return $this->currency_adjust('total') - $this->currency_adjust('service_charge') - $this->currency_adjust('host_fee');
        }
    }

    public function getGuestPayoutAttribute()
    {
        $payout = Payouts::where('user_id', $this->attributes['user_id'])->where('booking_id', $this->attributes['id'])->first();

        if (isset($payout->amount)) {
            return $payout->amount;
        } else {
            return $this->currency_adjust('total');
        }
    }

    public function currency_adjust($field)
    {   
        $default_currency = Currency::where('default', 1)->first()->code;
        $rate = Currency::whereCode(($this->attributes['currency_code']) ? ($this->attributes['currency_code']) :$default_currency)->first()->rate;


        $base_amount = $this->attributes[$field] / $rate;

      

        $session_rate = Currency::whereCode((Session::get('currency')) ? Session::get('currency') : $default_currency)->first()->rate;

        return round($base_amount * $session_rate);
    }

    public function currency_adjust_reports($field)
    {
        $rate = Currency::whereCode($this->attributes['currency_code'])->first()->rate;

        $base_amount = $this->attributes[$field] / $rate;

        $default_currency_rate = Currency::where('default', 1)->first()->rate;
        return round($base_amount * $default_currency_rate);
    }

    public function getCheckinCrossAttribute()
    {
        $date1=date_create($this->attributes['start_date']);
        $date2=date_create(date('Y-m-d'));
        if ($date2 < $date1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function getCheckoutCrossAttribute()
    {
        $date1=date_create($this->attributes['end_date']);
        $date2=date_create(date('Y-m-d'));
        if ($date2 < $date1) {
            return 0;
        } else {
            return 1;
        }
    }


    public function getOriginalPerNightAttribute()
    {
        return $this->attributes['per_night'];
    }

    public function getOriginalCustomPriceDatesAttribute()
    {
        if ($this->attributes['custom_price_dates'] != null) {
            return json_decode($this->attributes['custom_price_dates'], true);
        } else {
            return [];
        }
    }

    public function getOriginalBasePriceAttribute()
    {
        return $this->attributes['base_price'];
    }

    public function getOriginalCleaningChargeAttribute()
    {
        return $this->attributes['cleaning_charge'];
    }

    public function getOriginalGuestChargeAttribute()
    {
        return $this->attributes['guest_charge'];
    }

    public function getOriginalServiceChargeAttribute()
    {
        return $this->attributes['service_charge'];
    }

    public function getOriginalSecurityMoneyAttribute()
    {
        return $this->attributes['security_money'];
    }

    public function getOriginalHostFeeAttribute()
    {
        return $this->attributes['host_fee'];
    }

    public function getOriginalTotalAttribute()
    {
        return $this->attributes['total'];
    }
    public function getPerNightAttribute()
    {
        return $this->currency_adjust('per_night');
    }

    public function getBasePriceAttribute()
    {
        return $this->currency_adjust('base_price');
    }

    public function getCleaningChargeAttribute()
    {
        return $this->currency_adjust('cleaning_charge');
    }

    public function getGuestChargeAttribute()
    {
        return $this->currency_adjust('guest_charge');
    }

    public function getServiceChargeAttribute()
    {
        return $this->currency_adjust('service_charge');
    }

    public function getSecurityMoneyAttribute()
    {
        return $this->currency_adjust('security_money');
    }

    public function getHostFeeAttribute()
    {
        return $this->currency_adjust('host_fee');
    }

    public function getTotalAttribute()
    {
        return $this->currency_adjust('total');
    }

    public function getAmountsAttribute()
    {
        return $this->currency_adjust_reports('total');
    }

    public function getLabelColorAttribute()
    {
        if ($this->attributes['status'] == 'Accepted') {
            return 'success';
        } elseif ($this->attributes['status'] == 'Expired') {
            return 'info';
        } elseif ($this->attributes['status'] == 'Declined') {
            return 'info';
        } elseif ($this->attributes['status'] == 'Pending') {
            return 'warning';
        } elseif ($this->attributes['status'] == 'Cancelled') {
            return 'info';
        } elseif ($this->attributes['status'] == 'processing') {
            return 'secondary';
        }elseif ($this->attributes['status'] == '') {
            return 'inquiry';
        }
      
        return '';
    }

    public function getHostAccountAttribute()
    {
        $payout = Accounts::where('user_id', $this->attributes['host_id'])->where('selected', 'yes')->first();
       
        return (isset($payout->account) ? $payout->account : '');
    }

    public function getGuestAccountAttribute()
    {
        $payout = Accounts::where('user_id', $this->attributes['user_id'])->where('selected', 'yes')->first();
      return (isset($payout->account) ? $payout->account : '');
    }

    public function getCheckHostPayoutAttribute()
    {
        $exist = Payouts::where('booking_id', $this->attributes['id'])->where('user_type', 'Host')->where('status', 'Completed')->get();

        if ($exist->count()) {
            return 'yes';
        } else {
            return 'no';
        }
    }

    public function getGuestPayoutIdAttribute()
    {
        $payout = Payouts::where('user_id', $this->attributes['user_id'])->where('booking_id', $this->attributes['id'])->first();
        return $payout->id;
    }

    public function getHostPayoutIdAttribute()
    {
        $payout = Payouts::where('user_id', $this->attributes['host_id'])->where('booking_id', $this->attributes['id'])->first();
        return $payout->id;
    }

    public function getCheckGuestPayoutAttribute()
    {
        $exist = Payouts::where('booking_id', $this->attributes['id'])->where('user_type', 'Guest')->where('status', 'Completed')->get();
        
        if ($exist->count()) {
            return 'yes';
        } else {
            return 'no';
        }
    }

    public function getOriginalAdminHostPaymentAttribute()
    {
        $exist = Payouts::where('user_id', $this->attributes['host_id'])->where('booking_id', $this->attributes['id'])->get();
      
        if ($exist->count()) {
            return $exist[0]->original_amount;
        } else {
            return 0;
        }
    }

    public function getOriginalAdminGuestPaymentAttribute()
    {
        $exist = Payouts::where('user_id', $this->attributes['user_id'])->where('booking_id', $this->attributes['id'])->get();
      
        if ($exist->count()) {
            return $exist[0]->original_amount;
        } else {
            return 0;
        }
    }

    public function getAdminHostPaymentAttribute()
    {
        $exist = Payouts::where('user_id', $this->attributes['host_id'])->where('booking_id', $this->attributes['id'])->get();
      
        if ($exist->count()) {
            return $exist[0]->amount;
        } else {
            return 0;
        }
    }

    public function getAdminGuestPaymentAttribute()
    {
        $exist = Payouts::where('user_id', $this->attributes['user_id'])->where('booking_id', $this->attributes['id'])->get();

        if ($exist->count()) {
            return $exist[0]->amount;
        } else {
            return 0;
        }
    }

    public function currency_convert($amount)
    {
        $rate = Currency::whereCode($this->attributes['currency_code'])->first()->rate;

        $base_amount = $amount / $rate;

        $default_currency = Currency::where('default', 1)->first()->code;

        $session_rate = Currency::whereCode((Session::get('currency')) ? Session::get('currency') : $default_currency)->first()->rate;

        return round($base_amount * $session_rate);
    }


    public function getStartdateDmyAttribute()
    {
        $start_date =  date('D, F d, Y', strtotime($this->attributes['start_date']));
        return $start_date;
    }


    public function getEnddateDmyAttribute()
    {
        $end_date =  date('D, F d, Y', strtotime($this->attributes['end_date']));
        return $end_date;
    }

    public function getStartdateMdAttribute()
    {
        $start_date =  date('M d', strtotime($this->attributes['start_date']));
        return $start_date;
    }


    public function getEnddateMdAttribute()
    {
        $end_date =  date('M d', strtotime($this->attributes['end_date']));
        return $end_date;
    }

    public function getDateRangeAttribute()
    {
        return date('M d', strtotime($this->attributes['start_date'])).' - '.date('d, Y', strtotime($this->attributes['end_date']));
    }

    public function getExpirationTimeAttribute()
    {
        $expired_at =  date('Y/m/d H:i:s', strtotime(str_replace('-', '/', $this->attributes['created_at']).' +1 day'));
        return $expired_at;
    }

    public function getBookingLists()
    {
        $bookings = Bookings::join('properties', function ($join) {
                                $join->on('properties.id', '=', 'bookings.property_id');
        })
                        ->join('users', function ($join) {
                                $join->on('users.id', '=', 'bookings.user_id');
                        })
                        ->join('currency', function ($join) {
                                $join->on('currency.code', '=', 'bookings.currency_code');
                        })
                        ->leftJoin('users as u', function ($join) {
                                $join->on('u.id', '=', 'bookings.host_id');
                        })
                        ->select(['bookings.id as id', 'u.first_name as host_name', 'users.first_name as guest_name', 'bookings.property_id as property_id', 'properties.name as property_name', \DB::raw('CONCAT(bookings.total) AS total_amount'), 'bookings.status', 'bookings.created_at as created_at', 'bookings.updated_at as updated_at', 'bookings.start_date', 'bookings.end_date', 'bookings.guest', 'bookings.host_id', 'bookings.user_id', 'bookings.total', 'bookings.currency_code', 'bookings.service_charge', 'bookings.host_fee'])
                        ->take(5)
                        ->get();

        return $bookings;
    }

    public function getReviewDaysAttribute()
    {
        $start_date = $this->attributes['end_date'];
        $end_date = date('Y-m-d', strtotime($this->attributes['end_date'].' +14 days'));

        $datetime1 = new DateTime(date('Y-m-d'));
        $datetime2 = new DateTime($end_date);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%R%a');
        return $days+1;
    }

    public function review_user($id)
    {
        if ($this->attributes['user_id'] == $id) {
            $user_id = $this->attributes['host_id'];
        } else {
            $user_id = $this->attributes['user_id'];
        }

        return User::find($user_id);
    }
      
    public function review_details($id)
    {
        return Reviews::find($id);
    }
}
