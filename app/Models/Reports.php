<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Bookings;
use App\Models\Currency;
use App\Http\Helpers\Common;
use Session;
use DateTime;
use DB;

class Reports extends Model
{
    protected $helper;
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function getNights($startDate, $endDate, $propertyId = '')
    {
        $startDate   = $this->helper->y_m_d_convert($startDate);
        $endDate     = $this->helper->y_m_d_convert($endDate);

        if ($propertyId == '') {
            $totalNights = Bookings::whereBetween(DB::raw('date(updated_at)'), [$startDate, $endDate])->where(['cancelled_at' => null, 'cancelled_by' => null])->sum('total_night');
           
        } else {
            $totalNights = Bookings::whereBetween(DB::raw('date(updated_at)'), [$startDate, $endDate])->where(['property_id' => $propertyId, 'cancelled_at' => null, 'cancelled_by' => null])->sum('total_night');
        }

        return $totalNights;
    }

    public function getIncomes($startDate, $endDate, $propertyId = '')
    {
        $totalIncome = 0;
        $startDate   = $this->helper->y_m_d_convert($startDate);
        $endDate     = $this->helper->y_m_d_convert($endDate);
        if ($propertyId == '') {
            $incomes     = Bookings::whereBetween(DB::raw('date(updated_at)'), [$startDate, $endDate])->where(['cancelled_at' => null, 'cancelled_by' => null])->select(['total', 'currency_code', 'id'])->get();

            foreach ($incomes as $income) {
                $totalIncome += $income->amounts;
            }
        } else {
            $incomes     = Bookings::whereBetween(DB::raw('date(updated_at)'), [$startDate, $endDate])->where(['property_id' => $propertyId, 'cancelled_at' => null, 'cancelled_by' => null])->select(['total', 'currency_code', 'id'])->get();
            foreach ($incomes as $income) {
                $totalIncome += $income->amounts;
            }
        }
        return $totalIncome;
    }

    public function getReservations($startDate, $endDate, $propertyId = '')
    {
        $startDate   = $this->helper->y_m_d_convert($startDate);
        $endDate     = $this->helper->y_m_d_convert($endDate);

        if ($propertyId == '') {
            $totalReservations = Bookings::whereBetween(DB::raw('date(updated_at)'), [$startDate, $endDate])->where(['cancelled_at' => null])->count();
        } else {
            $totalReservations = Bookings::whereBetween(DB::raw('date(updated_at)'), [$startDate, $endDate])->where(['property_id' => $propertyId, 'cancelled_at' => null, 'cancelled_by' => null])->count();
        }
        return $totalReservations;
    }

    public function getMonthlyAvg($startDate, $endDate, $propertyId = '')
    {

        if ($propertyId != '') {
            $totalIncome       = $this->getIncomes($startDate, $endDate, $propertyId);
            $totalReservations = $this->getReservations($startDate, $endDate, $propertyId);
        } else {
            $totalIncome       = $this->getIncomes($startDate, $endDate);
            $totalReservations = $this->getReservations($startDate, $endDate);
        }
        if ($totalReservations != 0) {
            $monthlyAvg = $totalIncome / $totalReservations;
        } else {
            $monthlyAvg = 0;
        }
        return $monthlyAvg;
    }

    public function getCountryWiseResevations($from = null, $to = null, $propertyId = '')
    {
        $collection = BookingDetails::leftJoin('country', 'booking_details.value', '=', 'country.short_name')
                    ->leftJoin('bookings', 'booking_details.booking_id', '=', 'bookings.id')
                    ->groupBy('booking_details.value')
                    ->where('booking_details.field', '=', 'country')
                    ->where('booking_details.value', '!=', '')
                    ->selectRaw('country.short_name as code, country.name as name, count(booking_details.id) as value');
        if ($from != null) {
            $collection->whereDate('bookings.created_at', '>=', $from);
        }
        if ($to != null) {
            $collection->whereDate('bookings.created_at', '<=', $to);
        }
        if ($propertyId != '') {
            $collection->where('bookings.property_id', '=', $propertyId);
        }
        return $collection->get();
    }

    public function getSaleYears()
    {
        $data = DB::select("SELECT DISTINCT YEAR(updated_at) as year FROM bookings WHERE cancelled_at IS NULL AND cancelled_by IS NULL ORDER BY YEAR(updated_at) DESC");
        return $data;
    }
}
