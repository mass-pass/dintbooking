<?php

namespace App\Http\Controllers\Partner;

use Illuminate\Http\Request;
use App\Http\{
    Helpers\Common,
    Controllers\Controller
};
use Illuminate\Support\Facades\Response;
use Auth, DB;
use Carbon\Carbon;
use App\Models\{

    Settings,
    User,
    Messages,
    Bookings,
    Properties,
    PropertyDates,
    Payouts
};

class DashboardController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    /**
     * Partner Dashboard Show By Host 
     *  
     */
    public function index(Properties $property = null)
    {
        if ($property == null) {
            return selectPropertyFirst();
            // $data["properties"] =  Properties::where("host_id", $user->id)->select("id", "name", "bedrooms as rooms")->get();
            // $data["properties_ids"] =  Properties::where("host_id", $user->id)->distinct()->pluck('id');
            // $data["current_property_id"] = null;
        } else {
            $data["properties"] = Properties::where("id", $property->id)
                                ->with('property_layouts')
                                ->select("id", "name", "bedrooms as rooms")
                                ->get();
            $data["properties_ids"] = [$property->id];
            $data["current_property_id"] = $property->id;
            setCurrentPropertyIdInSession($property->id);
        }
        $data['title'] = 'Dashboard';
        $data["user"]  =  $user =  Auth::user();
        $data["bookings"] =  $bookings =  Bookings::where("host_id", $user->id)->get();

        $bookings = $bookings->toArray();
        $allDate = $this->helper->dateByFilter();
        $todayDate = substr($allDate['dayStartDate'], 0, 10);
        $data["today_arrivals"] = array_filter($bookings, function ($b) use ($todayDate) {
            return ($todayDate == $b["start_date"] && $b["status"] == "Accepted");
        });
        $data["today_departure"] = array_filter($bookings, function ($b) use ($todayDate) {
            return ($todayDate == $b["end_date"] && $b["status"] == "Accepted");
        });
        $data["today_booked"] = array_filter($bookings, function ($b) use ($todayDate) {
            return ($todayDate == substr($b["created_at"], 0, 10) && $b["status"] == "Accepted");
        });

        return view('partner.dashboard', $data);
    }
    /**
     * Partner Dashboard Show Reservation List 
     *  
     */
    public function propertiesReservation(Request $request)
    {
        $data['title'] = 'Dashboard';
        $data["user"]  =  $user =  Auth::user();
        $data['bookingsToday'] = [];
        $data['bookingsTomorrow'] = [];
        $data['guests'] = [];
        $todayDate = date("Y-m-d");
        $tomorrowDate =  date("Y-m-d", strtotime(date("Y-m-d") . ' +1 day'));
        $tab =  $request->tab;
        $currentPropertyId =  $request->currentPropertyId;
        if ($tab == 1) {
            $data["bookingsToday"] = Bookings::join("users as u", "u.id", "bookings.user_id")
                ->whereDate("bookings.start_date", $todayDate)
                ->where("bookings.host_id", $user->id)
                ->where("bookings.property_id", $currentPropertyId)
                ->where("bookings.status", "Accepted")
                ->select("bookings.*", "u.first_name", "u.last_name")
                ->get();
            $data["bookingsTomorrow"] = Bookings::join("users as u", "u.id", "bookings.user_id")
                ->whereDate("bookings.start_date", $tomorrowDate)
                ->where("bookings.host_id", $user->id)
                ->where("bookings.property_id", $currentPropertyId)
                ->where("bookings.status", "Accepted")
                ->select("bookings.*", "u.first_name", "u.last_name")
                ->get();
        }
        if ($tab == 2) {
            $data["bookingsToday"] = Bookings::join("users as u", "u.id", "bookings.user_id")
                ->whereDate("bookings.end_date", $todayDate)
                ->where("bookings.host_id", $user->id)
                ->where("bookings.property_id", $currentPropertyId)
                ->where("bookings.status", "Accepted")
                ->select("bookings.*", "u.first_name", "u.last_name")
                ->get();
            $data["bookingsTomorrow"] = Bookings::join("users as u", "u.id", "bookings.user_id")
                ->whereDate("bookings.end_date", $tomorrowDate)
                ->where("bookings.host_id", $user->id)
                ->where("bookings.property_id", $currentPropertyId)
                ->where("bookings.status", "Accepted")
                ->select("bookings.*", "u.first_name", "u.last_name")
                ->get();
        }
        if ($tab == 3) {
            $data["bookingsToday"] = Bookings::join("users as u", "u.id", "bookings.user_id")
                ->whereDate("bookings.end_date", $todayDate)
                ->where("bookings.host_id", $user->id)
                ->where("bookings.property_id", $currentPropertyId)
                ->where("bookings.status", "Accepted")
                ->select("bookings.*", "u.first_name", "u.last_name")
                ->get();
            $data["bookingsTomorrow"] = Bookings::join("users as u", "u.id", "bookings.user_id")
                ->whereDate("bookings.end_date", $tomorrowDate)
                ->where("bookings.host_id", $user->id)
                ->where("bookings.property_id", $currentPropertyId)
                ->where("bookings.status", "Accepted")
                ->select("bookings.*", "u.first_name", "u.last_name")
                ->get();
        }
        if ($tab == 4) {
            $data["guests"] = Bookings::join("users as u", "u.id", "bookings.user_id")
                ->whereDate("bookings.end_date", $todayDate)
                ->where("bookings.host_id", $user->id)
                ->where("bookings.property_id", $currentPropertyId)
                ->where("bookings.status", "Accepted")
                ->select("bookings.*", "u.first_name", "u.last_name")
                ->get();
        }
        $data["tab"] =  $tab;

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
    /**
     * Partner Dashboard Show Today Activity 
     *  
     */
    public function todayActivity(Request $request)
    {
        $todayDate = date("Y-m-d");
        $data["user"]  =  $user =  Auth::user();
        $data["tab"] = $request->tab;
        $currentPropertyId =  $request->currentPropertyId;
        if ($request->tab == 1) {
            // sales tab
            $data["bookings"] =  $bookings =  Bookings::join("users as u", "u.id", "bookings.user_id")
                ->whereDate("bookings.updated_at", $todayDate)
                ->where("bookings.host_id", $user->id)
                ->where("bookings.property_id", $currentPropertyId)
                ->where("bookings.status", "Accepted")
                ->select("bookings.*", "u.first_name", "u.last_name", DB::raw("bookings.total_night*bookings.per_night as revenue"))
                ->get();
            $bookings_array = $bookings->toArray();
            $data["today_booked"] = count($bookings);
            $data["list"] = $bookings;
            $data["total_nights"] = array_sum(array_column($bookings_array, "total_night"));
            $data["total_revenue"] = array_sum(array_column($bookings_array, "revenue"));
        }
        if ($request->tab == 2) {
            // cancel tab
            $data["bookings"] =  $bookings =  Bookings::join("users as u", "u.id", "bookings.user_id")
                ->whereDate("bookings.updated_at", $todayDate)
                ->where("bookings.host_id", $user->id)
                ->where("bookings.property_id", $currentPropertyId)
                ->where("bookings.status", "Cancelled")
                ->select("bookings.*", "u.first_name", "u.last_name", DB::raw("bookings.total_night*bookings.per_night as revenue"))
                ->get();
            $bookings_array = $bookings->toArray();
            $data["today_booked"] = count($bookings);
            $data["list"] = $bookings;
            $data["total_nights"] = array_sum(array_column($bookings_array, "total_night"));
            $data["total_revenue"] = array_sum(array_column($bookings_array, "revenue"));
        }
        if ($request->tab == 3) {
            // booking overlay
            $data["list"] = [];
        }

        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
    public function calendarOutlook(Request $request)
    {
        $data["user"]  =  $user =  Auth::user();
        $next = $request->next;
        $selectedDate =  $request->selected_date;
        $currentPropertyId =  $request->input('currentPropertyId', false);
        $carbonDate =   new \Carbon\Carbon($selectedDate);
        $startDate =   new \Carbon\Carbon($selectedDate);
        $totalbook = 0;
        if ($next == 1 || $next == 2) {
            $day = $carbonDate->addDays(13);
            $data["start_date"] = $start_date = $startDate->format("Y-m-d");
            $data["end_date"] = $end_date = $day->format("Y-m-d");
            $data["displayStartDate"] =  date("F d, Y", strtotime($start_date));
        } else {
            $day = $carbonDate->subDays(13);
            $data["end_date"] = $end_date = $startDate->format("Y-m-d");
            $data["start_date"] = $start_date = $day->format("Y-m-d");
            $data["displayStartDate"] =  date("F d, Y", strtotime($end_date));
        }
        $data["dateHead"] = date("F Y", strtotime($data['displayStartDate']));
        $data["days"] = $days     = $this->helper->get_days($start_date, $end_date);
        $data["available_property_ids"] = PropertyDates::whereIn('date', $days)->whereIn('property_id', $request->ids)->where('status', 'Available')->distinct()->pluck('property_id', 'date');
        $bookings = [];
        $total_earnings = 0;
        foreach ($days as $d) {
            $payout =  Payouts::join("bookings as b", "b.id", "payouts.booking_id")
                ->where("payouts.user_id", $user->id)
                ->where("b.start_date", "<=", $d)
                ->where("b.end_date", ">=", $d)
                ->select(DB::raw("sum(payouts.amount) as amount"))
                ->groupBy("payouts.user_id")->get();
            $amount = 0;
            if (count($payout) > 0) {
                $amount = $payout[0]->amount;
            }
            $total_earnings = $total_earnings + $amount;
            $booking =  Bookings::where("host_id", $user->id)
                ->where("start_date", "<=", $d)
                ->where("end_date", ">=", $d)
                ->where(function ($query) {
                    $query->orWhere("status", "Accepted")->orWhere("status", "Pending");
                })
                ->groupBy("property_id");
            if ($currentPropertyId && $currentPropertyId != "") {
                $booking->where("property_id", $currentPropertyId);
            }
            $booking = $booking->get();
            if (count($booking) > 0) {
                $totalbook++;
            }
            $bookings[] = array("date" => $d, "dateDisplay" => date("M d", strtotime($d)), "data" => $booking);
        }
        if ($totalbook > 0) {
            $totalPer = round(($totalbook * $request->rooms) / 100, 2);
            $totalPer = $totalbook;
        } else {
            $totalPer = 0;
        }
        $data["totalPer"] = $totalPer;
        $data["total_earnings"] = number_format($total_earnings, 2);
        $data["bookings"] =  $bookings;
        return response()->json([
            'status' => true,
            'data' => $data
        ], 200);
    }
    /**
     * Partner Reservation List 
     *  
     */
    public function ReservationList(Properties $property = null)
    {
        if ($property) {
            $data["current_property_id"] = $property->id;
        } else {
            return selectPropertyFirst();
        }
        $data["title"] = "Reservations";
        $data["user"]  = Auth::user();
        $data["endDate"] = $selectedDate =  date("Y-m-d");
        $endDate = new \Carbon\Carbon($selectedDate);
        $data["startDate"] = $endDate->subDays(14)->format("Y-m-d");

        return view('partner.reservation.list', $data);
    }
    /**
     * Partner Reservation List 
     *  
     */
    public function tableReservationList(Request $request)
    {

        $data["user"]  =  $user =  Auth::user();
        $data["tab"] = $request->tab;

        if (!Carbon::parse($request->start_date)) {
            $data["bookings"] = [];
        } else if (!Carbon::parse($request->end_date)) {
            $data["bookings"] = [];
        }
        if (strtotime($request->start_date) > strtotime($request->end_date)) {
            $data["bookings"] = [];
        } else {
            $status = $request->status;
            $data["bookings"] =  $bookings =  Bookings::join("users as u", "u.id", "bookings.user_id")
                ->whereBetween("bookings." . $request->date_of, [$request->start_date, $request->end_date])

                ->where("bookings.host_id", $user->id)
                ->where(function ($query) use ($status) {
                    if ($status != '')
                        $query->where("bookings.status", $status);
                })
                ->select("bookings.*", "u.first_name", "u.last_name", DB::raw("bookings.total_night*bookings.per_night as revenue"))
                ->get();
        }
        return view('partner.reservation.table', $data);
    }
}
