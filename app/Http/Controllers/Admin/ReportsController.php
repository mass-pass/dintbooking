<?php



namespace App\Http\Controllers\Admin;

use Validator;
use DateTime;
use DateInterval;
use DatePeriod;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use App\DataTables\ReportsDataTable;
use App\Http\Controllers\Controller;

use App\Models\{
    Reports,
    Currency,
    Properties,
    BookingDetails

};


class ReportsController extends Controller
{
    protected $helper;

    public function __construct(Reports $report)
    {
        $this->helper = new Common;
        $this->report = $report;
    }
    
    
    public function index(ReportsDataTable $dataTable)
    {
        return $dataTable->render('admin.reports.view');
    }

    public function display(Request $request)
    {
        $data['result'] = Report::find($request->id);

        return view('admin.reports.display', $data);
    }

    public function status_change(Request $request)
    {
        $report = Report::find($request->report_id);
        $report->status = $request->status;
        $report->save();

        $data['status'] = 1;
        echo json_encode($data);
    }

    public function delete(Request $request)
    {
        Report::find($request->id)->delete();

        $this->helper->one_time_message('success', 'Deleted Successfully');

        return redirect('admin/reports');
    }
 
    public function salesReports()
    {
        $data['default_cur_code'] = Currency::where('default', 1)->first();
        $months = $tempMonths = $monthsNumber = $monthlyNights = array();
        $j = 11;
        for ($i = 0; $i < 12; $i++) {
          // textual datetime description into a Unix timestamp
            $timestamp = strtotime("-$i month");
          // 'n' numeric representation of a month -1, without leading zeros
            $value =  date('n', strtotime("-$i month"));
          // a full textual representation of a month -1
            $text  =  date('F', strtotime("-$i month"));
            $monthYears[$j] = date("Y-m", strtotime(date('Y-m-01')." -$i months"));
            $monthsNumber[$j] = $value;
            $months[$j] = $text;
            $j--;
        }
        $dt = Carbon::now();
        $dt = $dt->subMonths(12);
        $startDate = $dt;
        $endDate = Carbon::now();
        
        $data['totalNights'] = $this->report->getNights($startDate, $endDate);
        $data['totalIncome'] = number_format($this->report->getIncomes($startDate, $endDate), 2, '.', ',');
        $data['totalReservations'] = $this->report->getReservations($startDate, $endDate);
        
        for ($i=0; $i <count($monthYears); $i++) {
            $startDate     = new Carbon('first day of '.$monthYears[$i]);
            $endDate       = new Carbon('last day of '.$monthYears[$i]);
            $monthlyNights[$i] = (int) $this->report->getNights($startDate, $endDate);
        }

        $data['months']   = json_encode($months);
        $data['monthlyNights'] = json_encode($monthlyNights);
        return view('admin.reports.salesReport', $data);
    }

    public function salesAnalysis()
    {
        $data['default_cur_code'] = Currency::where('default', 1)->first();
        $data['yearLists']        = $this->report->getSaleYears();

        isset(request()->year) ? $data['year'] = request()->year : $data['year'] = '';
        isset(request()->property) ? $data['allproperties'] = request()->property : $data['allproperties'] = '';
        if (isset(request()->reset_btn)) {
            request()->year = $data['year']  = '';
            request()->property = $data['allproperties']   = '';
        }

        if (isset(request()->property)) {
            $data['properties'] = $property = Properties::where('properties.id', request()->property)->select('id', 'name')->get();
        } else {
            $data['properties'] = $property = null;
        }

        if ($data['year'] == '') {
            $dt = Carbon::now();
            $dt = $dt->subMonths(12);
            $startDate = new Carbon('first day of '.$dt);
            $endDate = Carbon::now();
        } else {
            $startDate = Carbon::create($data['year']-1, 12, 1, 0);
            $endDate   = Carbon::create($data['year'], 12, 31, 0);
        }
        $interval = DateInterval::createFromDateString('1 month');
        $period   = new DatePeriod($startDate, $interval, $endDate);
        
        $monthYears = $monthlyAvg = $monthlyAvgDiff = $reservationRates = $reservationRateDiff = array();
        
        foreach ($period as $dt) {
            $monthYears[]     = $dt->format("F Y");
        }
        
        for ($i=0; $i <count($monthYears); $i++) {
            $startDate       = new Carbon('first day of '.$monthYears[$i]);
            $endDate         = new Carbon('last day of '.$monthYears[$i]);
            $monthlyAvg[$i]  = number_format($this->report->getMonthlyAvg($startDate, $endDate, $data['allproperties']), 2, '.', ',');

            $monthlyNights        = (int) $this->report->getNights($startDate, $endDate, $data['allproperties']);
            $countDays            =  $startDate->diffInDays($endDate) + 1;
            $reservationRates[$i] =  number_format((($monthlyNights / $countDays) * 100), 2, '.', ',');
        }

        //calculation for diffrence in reservation rates and average sale
        for ($i=1; $i <count($monthYears); $i++) {
            if ($monthlyAvg[$i-1] != 0) {
                $monthlyAvgDiff[$i]      = number_format((($monthlyAvg[$i] - $monthlyAvg[$i-1])/$monthlyAvg[$i-1]) * 100, 2, '.', ',');
            } else {
                $monthlyAvgDiff[$i]      = number_format(($monthlyAvg[$i] * 100), 2, '.', ',');
            }

            $reservationRateDiff[$i]     = number_format(($reservationRates[$i] - $reservationRates[$i-1]), 2, '.', ',');
        }
        
        if ($data['allproperties'] != '') {
            $data['propertyName'] = Properties::where('id', $data['allproperties'])->first()->name;
        } else {
            $data['propertyName'] = "All Properties";
        }

        $data['monthYears']          = $monthYears;
        $data['monthlyAvg']          = $monthlyAvg;
        $data['reservationRates']    = $reservationRates;
        $data['monthlyAvgDiff']      = $monthlyAvgDiff;
        $data['reservationRateDiff'] = $reservationRateDiff;
        
        return view('admin.reports.salesAnalysis', $data);
    }

    public function searchProperty(Request $request)
    {
        $str = $request->term;
        
        if ($str==null) {
            $myresult = Properties::where('status', 'Listed')->select('id', 'name')->take(5)->select('properties.id', 'properties.name AS text')->get();
        } else {
            $myresult         = Properties::where('properties.name', 'LIKE', '%'.$str.'%')->select('properties.id', 'properties.name AS text')->get();
        }

        if ($myresult->isEmpty()) {
            $myArr=null;
        } else {
            $arr2 = array(
                "id"   => "",
                "text" => "All"
              );
              $myArr[] = ($arr2);
            foreach ($myresult as $result) {
                $arr = array(
                  "id"   => $result->id,
                  "text" => $result->text
                );
                $myArr[] = ($arr);
            }
        }
        return $myArr;
    }

    public function overviewStats()
    {
        $data['from'] = isset(request()->from) ? request()->from : null;
        $data['to']   = isset(request()->to) ? request()->to : null;
        if (isset(request()->property)) {
            $data['properties'] = Properties::where('properties.id', request()->property)->select('id', 'name')->get();
        } else {
            $data['properties'] = null;
        }

        if (isset(request()->reset_btn)) {
            $data['from']        = null;
            $data['to']          = null;
            $data['allproperties']   = '';
            $collections = $this->report->getCountryWiseResevations();

            $totalReservations = 0;
            if ($collections != null) {
                foreach ($collections as $collection) {
                    $totalReservations += (int) $collection->value;
                }
            }

            $data['totalReservations'] = $totalReservations;
            $data['collections'] = json_encode($collections);
            $data['countryCodes'] = $collections;
            return view('admin.reports.overview', $data);
        }
        isset(request()->property) ? $data['allproperties'] = request()->property : $data['allproperties'] = '';
   
        $collections = $this->report->getCountryWiseResevations($data['from'], $data['to'], $data['allproperties']);

        $totalReservations = 0;
        if ($collections != null) {
            foreach ($collections as $collection) {
                $totalReservations += (int) $collection->value;
            }
        }
        $data['totalReservations'] = $totalReservations;
        $data['collections'] = json_encode($collections);
        $data['countryCodes'] = $collections;

        return view('admin.reports.overview', $data);
    }
}
