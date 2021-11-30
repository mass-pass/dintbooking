<?php
namespace App\Http\Controllers;

use Auth, DB, validator;
use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\{
    Messages,
    Properties,
    Bookings
};


class InboxController extends Controller
{
    private $helper;
    
    public function __construct()
    {
        $this->helper = new Common;
    }
    
    /**
    * Inbox Page
    * Conversassion List
    * Message View
    */
    public function index(Request $request)
    {
        $data['messages']  = Messages::where('sender_id', Auth::id())
                            ->orWhere('receiver_id', Auth::id())
                            ->orderBy('id', 'desc')->get()
                            ->unique('booking_id');

        if ( count($data['messages']) > 0 ) {
            $booking_id             = $data['messages'][0]->booking_id;
            $data['conversassion']  = Messages::where('booking_id', $booking_id)->get();
            $data['booking']        = Bookings::where('id', $booking_id)
                                                ->with('users','properties')
                                                ->first();
        }
        
        return view('users.inbox', $data); 
    }

    /**
    * Message Read status Change
    * Details pass according to booking message
    */
    public function message(Request $request)
    {
        $booking_id = $request->id;
        $message = Messages::where([['booking_id', '=', $booking_id], ['receiver_id', '=', Auth::id()]])->update(['read' => 1]);
 
        $data['messages'] = Messages::where('booking_id', $booking_id)->get();
        $data['booking'] = Bookings::where('id', $booking_id)
                          ->with('host')->first();
        return response()->json([
             "inbox"=>view('users.messages', $data)->render(), "booking"=>view('users.booking', $data)->render()
        ]);
    }

    /**
    * Message Reply 
    * Message read status change
    */
    public function messageReply(Request $request)
    {
        $messages = Messages::where([['booking_id', '=', $request->booking_id], ['receiver_id', '=', Auth::id()]])->update(['read' => 1]);

        $rules = array(
            'msg'      => 'required|string',
        );

        $validator = Validator::make($request->all(), $rules);

        if (!$validator->fails()) {     
            $message = new Messages;
            $message->property_id = $request->property_id;
            $message->booking_id = $request->booking_id;
            $message->receiver_id = $request->receiver_id;
            $message->sender_id = Auth::id();
            $message->message = $request->msg;
            $message->type_id = 1;
            $message->save();
            return 1;
        }
    }
}
