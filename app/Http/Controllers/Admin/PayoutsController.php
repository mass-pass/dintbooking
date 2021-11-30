<?php



namespace App\Http\Controllers\Admin;


use PDF;
use Validator;
use DB;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PayoutsDataTable;
use App\Exports\PayoutsExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Helpers\Common;

use App\Models\{
    Payouts,
    Withdrawal,
    Settings,
    Properties,
    Currency,
    Wallet,
    PaymentMethods
};



class PayoutsController extends Controller
{
    protected $helper;
    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(PayoutsDataTable $dataTable)
    {

        $data['from'] = isset(request()->from) ? request()->from : null;
        $data['to']   = isset(request()->to) ? request()->to : null;
        if (isset(request()->property)) {
            $data['properties'] = Properties::where('properties.id', request()->property)->select('id', 'name')->get();
        } else {
            $data['properties'] = null;
        }

        if (isset(request()->btn)) {
            $status     = request()->status;
            $from       = request()->from;
            $to         = request()->to;
            if (isset(request()->property)) {
                $property    = request()->property;
            } else {
                $property    = null;
            }
        } else {
            $status     = null;
            $types      = null;
            $property   = null;
            $from       = null;
            $to         = null;
        }

        $total_payouts_initial = $this->getAllPayouts();
        $total_payouts         = $this->getAllPayouts();
        $data['total_payouts'] = $total_payouts->get()->count();

        $different_currency_total_initial  = $total_payouts_initial->select('payouts.currency_code as currency_code', DB::raw('SUM(payouts.amount) AS total_amount'))->groupBy('currency_code');
        $different_currency_total          = $different_currency_total_initial->get();
        $data['different_total_amounts']   = $this->getDistinctCurrencyTotalWithSymbol($different_currency_total);
        $data['totalPayouts']       = Withdrawal::where('status','=','Success')->count();
        $data['totalPayoutsAmount'] = Withdrawal::sum('amount');

       
        if (isset(request()->reset_btn)) {
            $data['from']        = null;
            $data['to']          = null;
            $data['allstatus']   = '';
            $data['alltypes']   = '';
            $data['allproperties']   = '';
            return $dataTable->render('admin.payouts.view', $data);
        }

        if ($from) {
            $total_payouts = $total_payouts->whereDate('payouts.created_at', '>=', $from);
            $different_currency_total_initial = $different_currency_total_initial->whereDate('payouts.created_at', '>=', $from);
        }
        if ($to) {
            $total_payouts = $total_payouts->whereDate('payouts.created_at', '<=', $to);
            $different_currency_total_initial = $different_currency_total_initial->whereDate('payouts.created_at', '<=', $to);
        }
        if ($property) {
            $total_payouts = $total_payouts->where('payouts.property_id', '=', $property);
            $different_currency_total_initial = $different_currency_total_initial->where('payouts.property_id', '=', $property);
        }
        if ($status) {
            $total_payouts = $total_payouts->where('payouts.status', '=', $status);
            $different_currency_total_initial = $different_currency_total_initial->where('payouts.status', '=', $status);
        }
   

        $data['total_payouts']            = $total_payouts->get()->count();
        $different_currency_total_initial = $different_currency_total_initial->get();

        if (count($different_currency_total_initial)) {
            $data['different_total_amounts'] = $this->getDistinctCurrencyTotalWithSymbol($different_currency_total_initial);
        } else {
            $data['different_total_amounts'] = null;
        }


        isset(request()->property) ? $data['allproperties'] = request()->property : $data['allproperties'] = '';
        isset(request()->status) ? $data['allstatus'] = request()->status : $data['allstatus'] = '';
        isset(request()->types) ? $data['alltypes']   = request()->types : $data['alltypes'] = '';

        return $dataTable->render('admin.payouts.view', $data);
    }
    public function edit(Request $request)
    { 

       if (! $request->isMethod('post')) {

            $data['withDrawal'] = Withdrawal::where('id',$request->id)->first();
                 
            return view('admin.payouts.edit',$data);
       } else {

            if ($request->status == 'Success') {

                $withDrawal = Withdrawal::find($request->id);
                $withDrawal->status   = $request->status;      
                $withDrawal->amount   = $withDrawal->subtotal;
                $withDrawal->subtotal = 0;
                $withDrawal->save();

                $wallet = Wallet::where('user_id', $withDrawal->user_id)->first();
                
                $balance =  ($wallet->balance - $withDrawal->amount);
                Wallet::where(['user_id' =>$withDrawal->user_id])->update(['balance' => $balance]);
                
            }

            $this->helper->one_time_message('success', "Successfully updated");
            return redirect('admin/payouts');
        } 

    }

    public function details(Request $request)
    { 
        $data['withDrawal'] = Withdrawal::find($request->id);
        return view('admin.payouts.details', $data);
    }

    public function getDistinctCurrencyTotalWithSymbol($different_currency_total)
    {
        $different_total_amounts = null;
        foreach ($different_currency_total as $key => $value) {
            $current_currency_symbol = Currency::where('code', $value->currency_code)->select('symbol AS currency_symbol')->first();
            $different_total_amounts[$key]['total'] = moneyFormat($current_currency_symbol->currency_symbol, $value->total_amount);
            $different_total_amounts[$key]['currency_code'] = $value->currency_code;
        }
        return $different_total_amounts;
    }

    public function payoutsPdf($id = null)
    {
        $to                 = setDateForDb(request()->to);
        $from               = setDateForDb(request()->from);
        $data['companyLogo']  = $logo  = Settings::where('name', 'logo')->select('value')->first();
        if ($logo->value == null) {
            $data['logo_flag'] = 0;
        } elseif (!file_exists("front/images/logos/$logo->value")) {
            $data['logo_flag'] = 0;
        }

        $data['status']     = $status = isset(request()->status) ? request()->status : 'null';
       

        $query = Withdrawal::orderBy('id', 'desc')->select();

        if ($from) {
            $query->whereDate('created_at', '>=', $from);
        }

        if ($to) {
            $query->whereDate('created_at', '<=', $to);
        }

        if ($status) {
            $query->where('status', '=', $status);
        }   
        if ($from && $to) {
            $data['date_range'] = onlyFormat($from) . ' To ' . onlyFormat($to);
        }
        
        $data['payoutList'] = $query->get();
        $pdf = PDF::loadView('admin.payouts.list_pdf', $data, [], [
            'format' => 'A3', [750, 1060]
          ]);
        return $pdf->download('payouts_list_' . time() . '.pdf', array("Attachment" => 0));
    }

    public function payoutsCsv($id = null)
    { 
        return Excel::download(new PayoutsExport, 'payouts_sheet' . time() .'.xls');
    }

    public function getAllPayouts()
    {
        $allPayouts = Payouts::join('properties', function ($join) {
            $join->on('properties.id', '=', 'payouts.property_id');
        })
        ->join('users', function ($join) {
                $join->on('users.id', '=', 'payouts.user_id');
        })
        ->join('currency', function ($join) {
                $join->on('currency.code', '=', 'payouts.currency_code');
        })
        ->select(['properties.name as property_name', 'users.first_name AS user', DB::raw('CONCAT(currency.symbol, payouts.amount) AS payouts_amount'), DB::raw('CONCAT(currency.symbol, payouts.penalty_amount) AS penalty'), 'payouts.account as payouts_account', 'payouts.created_at as payouts_date', 'payouts.*']);
        // ->orderBy('payouts.id', 'desc');

        return $allPayouts;
    }

    public function getAllPayoutsCSV()
    {
        $allPayouts = Payouts::join('properties', function ($join) {
            $join->on('properties.id', '=', 'payouts.property_id');
        })
        ->join('users', function ($join) {
                $join->on('users.id', '=', 'payouts.user_id');
        })
        ->join('currency', function ($join) {
                $join->on('currency.code', '=', 'payouts.currency_code');
        })
        ->select(['properties.name as property_name', 'users.first_name AS user', DB::raw('payouts.amount AS payouts_amount'), DB::raw('payouts.penalty_amount AS penalty'), 'payouts.account as payouts_account', 'payouts.created_at as payouts_date', 'payouts.*'])
        ->orderBy('payouts.id', 'desc');

        return $allPayouts;
    }
}
