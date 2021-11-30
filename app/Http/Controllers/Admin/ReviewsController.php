<?php



namespace App\Http\Controllers\Admin;

use PDF;
use Validator;
use App\Exports\ReviewsExport;
use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\DataTables\ReviewsDataTable;

use App\Models\{
    Properties,
    Reviews,
    Settings
};




class ReviewsController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(ReviewsDataTable $dataTable)
    {
        $data['from'] = isset(request()->from) ? request()->from : null;
        $data['to']   = isset(request()->to) ? request()->to : null;
        $data['property'] = Properties::get();

        if (isset(request()->property)) {
            $data['properties'] = $properties = Properties::where('properties.id', request()->property)->select('id', 'name')->get();
        } else {
            $data['properties'] = null;
        }
        if (isset(request()->reset_btn)) {
            $data['from']          = null;
            $data['to']            = null;
            $data['allreviewer']   = '';
            $data['allproperties'] = '';
            return $dataTable->render('admin.reviews.view', $data);
        }
        isset(request()->property) ? $data['allproperties'] = $allproperties = request()->property : $data['allproperties'] = $allproperties = '';
        isset(request()->reviewer) ? $data['allreviewer'] = $allreviewer = request()->reviewer : $data['allreviewer'] = $allreviewer = '';
        return $dataTable->render('admin.reviews.view', $data);
    }

    public function edit(Request $request)
    {
        
        if (!$request->isMethod('post')) {
            $data['result'] = Reviews::join('properties', function ($join) {
                                $join->on('properties.id', '=', 'reviews.property_id');
            })
                        ->join('users', function ($join) {
                                $join->on('users.id', '=', 'reviews.sender_id');
                        })
                        ->join('users as receiver', function ($join) {
                                $join->on('receiver.id', '=', 'reviews.receiver_id');
                        })
                        ->where('reviews.id', $request->id)->select(['reviews.id as id', 'booking_id', 'properties.name as property_name', 'users.first_name as sender', 'receiver.first_name as receiver', 'reviewer','rating','accuracy','location','communication','checkin','cleanliness','value','message'])->first();
            return view('admin.reviews.edit', $data);
        } elseif ($request->submit) {
           
            $rules = array(
                    'message' => 'required'
                    );

            $niceNames = array(
                        'message' => 'Message'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($niceNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput(); 
            } else {
                $user                  = Reviews::find($request->id);
                $user->message         = $request->message;
                $user->rating          = $request->rating;
                $user->accuracy        = $request->accuracy;
                $user->location        = $request->accuracy;
                $user->communication   = $request->communication;
                $user->checkin         = $request->checkin;
                $user->cleanliness     = $request->cleanliness;
                $user->value           = $request->value;
                 
                $user->save();
                $this->helper->one_time_message('success', 'Updated Successfully'); 
                return redirect('admin/reviews');
            }
        } else {
            return redirect('admin/reviews');
        }
    }
    
  
    public function searchReview(Request $request)
    {

        $str = $request->term;
        if ($str == null) {
           
            $myresult = Reviews::with(['properties' => function ($query) {
                $query->select('id', 'name as text');
            }])->distinct()->get(['property_id']);
        } else {
            $myresult = Reviews::with(['properties' => function ($query) use ($str) {
                $query->where('name', 'LIKE', '%'.$str.'%')
                      ->select('id', 'name as text');
            }])->get();
        }
        $arr2 = array(
            "id" => "",
            "text" => "All"
            );
      
        $myArr[] = ($arr2);
        foreach ($myresult as $result) {
            if ($result->properties!=null) {
                $arr = array(
                "id" => $result->properties->id,
                "text" => $result->properties->text
                );
                $myArr[] = ($arr);
            }
        }
        
        return $myArr;
    }

    public function reviewCsv()
    {
        return Excel::download(new ReviewsExport, 'reviews_sheet' . time() .'.xls');

    }

    public function reviewPdf()
    {
        $to                 = request()->to;
        $from               = request()->from;
        $data['companyLogo']  = $logo  = Settings::where('name', 'logo')->select('value')->first();
        if ($logo->value == null) {
            $data['logo_flag'] = 0;
        } elseif (!file_exists("front/images/logos/$logo->value")) {
            $data['logo_flag'] = 0;
        }
        $data['reviewer']     = $reviewer = isset(request()->reviewer) ? request()->reviewer : 'null';
        $data['property']     = $property = isset(request()->property) ? request()->property : 'null';
        $reviews              = $this->getAllReviews();
        if ($from) {
            $reviews->whereDate('reviews.created_at', '>=', $from);
        }
        if ($to) {
            $reviews->whereDate('reviews.created_at', '<=', $to);
        }
        if ($property) {
            $reviews->where('properties.id', '=', $property);
        }
        if ($reviewer) {
            $reviews->where('reviews.reviewer', '=', $reviewer);
        }
        if ($from && $to) {
            $data['date_range'] = $from . ' To ' . $to;
        }
        
        $data['reviewList'] = $reviews->get();
        $pdf = PDF::loadView('admin.reviews.list_pdf', $data, [], [
            'format' => 'A3', [750, 1060]
          ]);
        return $pdf->download('review_list_' . time() . '.pdf', array("Attachment" => 0));
    }

    public function getAllReviews()
    {
        $reviews = Reviews::join('properties', function ($join) {
            $join->on('properties.id', '=', 'reviews.property_id');
        })
        ->join('users', function ($join) {
                $join->on('users.id', '=', 'reviews.sender_id');
        })
        ->join('users as receiver', function ($join) {
                $join->on('receiver.id', '=', 'reviews.receiver_id');
        })
        ->select(['reviews.id as id', 'booking_id', 'properties.name as property_name', 'properties.id as property_id', 'users.first_name as sender', 'receiver.first_name as receiver', 'reviewer', 'message', 'reviews.created_at as created_at', 'reviews.updated_at as updated_at'])
        ->orderBy('reviews.id', 'desc');
        return $reviews;
    }
}
