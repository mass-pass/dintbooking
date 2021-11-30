<?php

namespace App\Http\Controllers\Partner;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Common;
use App\Models\Bookings;
use App\Models\Messages;
use http\Message;
use Illuminate\Http\Request;
use App\Models\{
    Properties,
};
class MessageController extends Controller
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
        if ($property) {
            $current_property_id = $property->id;
        } else {
            return selectPropertyFirst();
        }
        $title = 'Inbox';
        $user_id = \Auth::user()->id;
        $bookings = Bookings::whereHas('messages')
                    ->with('messages','users')
                    ->where('property_id', $current_property_id)
                    ->get();
        
        return view('partner.message.index', compact('title', 'bookings', 'current_property_id'));
    }

    public function getMessageDetails(Request $request, $booking_id)

    {
        $user_id = auth()->user()->id;
        $resp = $this->bookingDetails($booking_id);

        //before returning results check if the user is the host of the booking
//        if($booking->host_id != $user_id){
//            return response([
//                'message' => 'Unauthorized Action',
//            ],404);
//        }

        return response()->json($resp,200);
    }

    /**
     * This is just the common function to get booking details
     * and should be called only from router not routes of this will be available
     * @param $booking_id
     * @return \Illuminate\Database\Eloquent\Builder|\Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function bookingDetails($booking_id)
    {
        Messages::where('booking_id',$booking_id)
            ->where('receiver_id',auth()->user()->id)
            ->update(['read' => 1]);
        $booking = Bookings::with(['messages' => function($q){
            $q->orderBy('created_at','asc');
        },'users'])->findOrFail($booking_id);
        $data['reservation'] =\View::make('partner.message._reservationDetails')->with('booking',$booking)->render();
        $data['chat'] =\View::make('partner.message._chat')->with('booking',$booking)->render();
        return $data;
    }

    public function storeNewMessage(Request $request)
    {
        //this read should be set to 1
        $message = Messages::create([
            'property_id'               => $request->input('property_id'),
            'booking_id'                => $request->input('booking_id'),
            'sender_id'                 => $request->input('sender_id'),
            'receiver_id'               => $request->input('receiver_id'),
            'message'                   => $request->input('new_message'),
            'type_id'                   => 1,
            'read'                      => 0,
            'created_at'                => now(),
            'updated_at'                => now()
        ]);
        return response([
                'created_at'    => $message->created_at->format('M d,Y h:i a')
            ],200);
    }
}
