<?php

namespace App\Http\Controllers\Partner\Traits\Calendar;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Carbon\CarbonPeriod;

use App\Models\{
    Properties,
    Bookings
};

/**
 * 
 * This trait contains all the data which is related to calender.
 * 
 */

trait CalendarData
{

    public function getCalendarData(Request $request)
    {
        $dates = $request->input('dates', false);
        if (!$dates || !$dates['startDate'] || !$dates['endDate']) {
            return response()->json([
                'status' => false
            ], 422);
        }

        $data = [];
        $data['allRoomsData'] = $this->getAllRoomData([
            'startDate' => $dates['startDate'],
            'endDate' => $dates['endDate']
        ]);
        $data['propertiesData'] = $this->getPropertiesDataForCalendar([
            'startDate' => $dates['startDate'],
            'endDate' => $dates['endDate'],
            'propertyId' => $request->input('property_id')
        ]);

        $data['dates'] = [
            'startDate' => $dates['startDate'],
            'endDate' => $dates['endDate']
        ];

        return response()->json([ 
            'status' => true,
            'data' => $data
        ], 200);
    }
    /**
     * @method getPropertyLayouts: Function to get property layouts.
     * 
     * @param array $filterData : Data according to which we need to filter data.
     * 
     * $filterData = [
     *   'startDate' => '2012-01-01',
     *   'endDate' => '2012-01-31'
     * ];
     * 
     **/
    public function getPropertiesDataForCalendar(array $filterData)
    {
        $propertiesToShow = [];
        // Check if logged in user is allowed to fetch the details of the $propertyId.
        $properties = \Auth::user()->properties;
        $properties = Properties::where('id', $filterData['propertyId'])
                        ->with('property_layouts')
                        ->get();
        if ($properties->isNotEmpty()) {
            foreach ($properties as $property) {
                foreach ($property->property_layouts as $propertyLayout) {
                    $propertyLayout['propertyLayoutPricing'] = $propertyLayout->getPricingForDates($filterData['startDate'], $filterData['endDate']);
                    $propertyLayout->property_units;
                    $bookings = Bookings::with('users')
                                ->where("property_layout_id", $propertyLayout->id)
                                ->where("start_date", '>=', $filterData['startDate'])
                                ->where("start_date", '<=', $filterData['endDate'])
                                ->where("status", "Accepted")
                                ->orderBy('start_date', 'ASC')
                                ->get();
                    // if ($bookings->isNotEmpty()) {
                      
                    //     $pendingBooking = [];
                    //     foreach ($propertyLayout->beds as $bed) {
                    //         foreach ($bookings as $booking) {
                            
                    //         }
                    //         $bed->reservation = [];
                    //         $bed->reservation[] = [
                                
                    //         ];
                    //         dd($bed);
                    //     }
                    // }
                    // dd($bookings->toArray());
                }
            }
            $propertiesToShow = $properties->toArray();
        }
        
        return ['properties' => $propertiesToShow];
    }

    /**
     * @method getAllRoomData: This function return the data of first row of the calendar.
     * 
     * @param array $filterData : Data according to which we need to filter data.
     * 
     * $filterData = [
     *   'startDate' => '2012-01-01',
     *   'endDate' => '2012-01-31'
     * ];
     * 
     * @return array
     */
    public function getAllRoomData(array $filterData)
    {
        $allRoomData = [];
        $from = Carbon::parse($filterData['startDate']);
        $to = Carbon::parse($filterData['endDate']);
        $period = CarbonPeriod::create($from, $to);
        foreach ($period as $date) {
            $allRoomData[$date->format('F Y')][$date->format('D j')] = [
                'total_booking' => 12,
                'booking_percentage' => 30
            ];
        }

        return $allRoomData;
    }

    public function getCalendarReservationData(Request $request)
    {
        $dates = $request->input('dates', false);
        if (!$dates || !$dates['startDate'] || !$dates['endDate']) {
            return response()->json([
                'status' => false
            ], 422);
        }

        $bookings = Bookings::with('users', 'host')
            ->where("bookings.start_date", '>=', $dates['startDate'])
            ->where("bookings.host_id", auth()->user()->id)
            ->where("bookings.status", "Accepted")
            ->get();
        
        if ($bookings->isNotEmpty()) {
            return response()->json([
                'status' => true,
                'reservationData' => $bookings->toArray()
            ], 200);
        }

        return response()->json([
            'status' => false,
            'reservationData' => []
        ], 200);
    }
}
