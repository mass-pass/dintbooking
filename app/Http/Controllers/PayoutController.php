<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Helpers\Common;

use App\Models\{
    Settings,
    Country,
    PayoutSetting,
    Withdrawal,
    Wallet,
    Accounts,
    PaymentMethods,
    Currency
};

use App\DataTables\PayoutListDataTable;
use Auth;
use DB;
use Session;
use Validator;
use DateTime;

class PayoutController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index() 
    {   
        $data['title'] = 'Payout Setting';
        $data['payouts'] = PayoutSetting::with('payment_methods')->where(['user_id' => Auth::user()->id])->paginate(Session::get('row_per_page'));

        $data['countries'] = Country::getAll();
        $data['paymentMethods'] = PaymentMethods::whereNotIn('name', ['Revepay', 'Stripe', 'Wallet'])->get();

        return view('payouts.view', $data);
    }

    public function setting(Request $request)
    {

      $data['currency_code'] = Currency::where('default', 1)->first();
      $currency_code = $data['currency_code']->code; 
      $data['countries'] = Country::getAll();

      if (!$request->isMethod('post')) {
      	return view('payouts.add',$data);

      } elseif ($request->isMethod('post')) {

          if ($request->payout_type == 1) {
              
              $rules = array(
                  'email' => 'required|email|unique:payout_settings',
              );

              $fieldNames = array(
                  'email'  => 'Paypal Email',
              );

              $validator = Validator::make($request->all(), $rules);
              $validator->setAttributeNames($fieldNames); 

              if ($validator->fails()) {
                  return back()->withErrors($validator)->withInput(); 
              } else {
                  $payoutSetting                        = new PayoutSetting;
                  $payoutSetting->user_id               = Auth::user()->id;
                  $payoutSetting->type                  = $request->payout_type;
                  $payoutSetting->email                 = $request->email;          
                  $payoutSetting->account_name          = Auth::user()->full_name;          
                  $payoutSetting->save();

                  $paymentAccount                        = new Accounts;
                  $paymentAccount->user_id               = Auth::user()->id;
                  $paymentAccount->account               = $request->email;
                  $paymentAccount->currency_code         = $currency_code;
                  $paymentAccount->payment_method_id     = 1;
                  $paymentAccount->selected              = 'No';
                  $paymentAccount->save();

                  $this->helper->one_time_message('success', trans('messages.success.added_success'));
                  return redirect('users/payout');
              }

          }else{
            $rules = array(
                'bank_account_holder_name'    => 'required|max:255',
                'bank_account_number'         => 'required|max:255',
                'swift_code'                  => 'required|max:255',
                'bank_name'                   => 'required|max:255',
            );

            $fieldNames = array(
                'bank_account_holder_name'    => 'Bank Account Holder Name',
                'bank_account_number'         => 'Bank Account Number/IBAN',
                'swift_code'                  => 'BVN Number',
                'bank_name'                   => 'Bank Name', 
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames); 

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput(); 
            } else {
                $payoutSetting                      = new PayoutSetting;
                $payoutSetting->user_id             = Auth::user()->id;
                $payoutSetting->type                = $request->payout_type;
                $payoutSetting->email               = Auth::user()->email;
                $payoutSetting->account_name        = $request->bank_account_holder_name;
                $payoutSetting->account_number      = $request->bank_account_number;
                $payoutSetting->bank_branch_name    = $request->branch_name;
                $payoutSetting->bank_branch_city    = $request->branch_city;
                $payoutSetting->swift_code          = $request->swift_code;
                $payoutSetting->bank_branch_address = $request->branch_address;
                $payoutSetting->bank_name           = $request->bank_name;
                $payoutSetting->country             = $request->country;
                $payoutSetting->save();


                $paymentAccount                        = new Accounts;
                $paymentAccount->user_id               = Auth::user()->id;
                $paymentAccount->account               = Auth::user()->email;
                $paymentAccount->currency_code         = $currency_code;
                $paymentAccount->payment_method_id     = 4;
                $paymentAccount->selected              = 'No';

                $paymentAccount->save();

                $this->helper->one_time_message('success', trans('messages.success.added_success'));

                return redirect('users/payout');
            }
        }
      }
    } 

    public function edit(Request $request)
    {  
       if (!$request->isMethod('post')) {
            $data['payoutSetting'] = PayoutSetting::with('payment_methods')->find($request->id);
            $data['countries'] = Country::all();
           return view('payouts.edit',$data);
        } elseif ($request->isMethod('post')) {
            if($request->payout_type == 1){
              $rules = array(
                'email'    => 'required|email',
              );
              $fieldNames = array(
                'Email'    => 'Email Account',
              );
              $validator = Validator::make($request->all(), $rules);
              $validator->setAttributeNames($fieldNames); 
              if ($validator->fails()) {
                  return back()->withErrors($validator)->withInput(); 
              } else {
                  $payoutSetting                     = PayoutSetting::find($request->id);
                  $payoutSetting->email               = $request->email;
                  $payoutSetting->save();
                  $this->helper->one_time_message('success', "Updated Successfully");
                  return redirect('users/payout');
              }
            }else{    
                $rules = array(
                    'bank_account_holder_name'    => 'required|max:255',
                    'bank_account_number'         => 'required|max:255',
                    'branch_name'                 => 'required|max:255',
                    'branch_city'                 => 'required|max:255',
                    'swift_code'                  => 'required|max:255',
                    'branch_address'              => 'required|max:255',
                    'bank_name'                   => 'required|max:255',   
                );
                
                $fieldNames = array(
                    'bank_account_holder_name'    => 'Bank Account Holder Name',
                    'bank_account_number'         => 'Bank Account Number/IBAN',
                    'branch_name'                 => 'Branch Name',
                    'branch_city'                 => 'Branch City',
                    'swift_code'                  => 'SWIFT Code',
                    'branch_address'              => 'Branch Address',
                    'bank_name'                   => 'Bank Name', 
                );

                $validator = Validator::make($request->all(), $rules);
                $validator->setAttributeNames($fieldNames); 

                if ($validator->fails()) {
                    return back()->withErrors($validator)->withInput(); 
                } else {
                    $payoutSetting                     = PayoutSetting::find($request->id);

                    $payoutSetting->user_id             = Auth::user()->id;
                    $payoutSetting->type                = $request->payout_type;
                    $payoutSetting->email               = Auth::user()->email;
                    $payoutSetting->account_name        = $request->bank_account_holder_name;
                    $payoutSetting->account_number      = $request->bank_account_number;
                    $payoutSetting->bank_branch_name    = $request->branch_name;
                    $payoutSetting->bank_branch_city    = $request->branch_city;
                    $payoutSetting->swift_code          = $request->swift_code;
                    $payoutSetting->bank_branch_address = $request->branch_address;
                    $payoutSetting->bank_name           = $request->bank_name;
                    $payoutSetting->country             = $request->country;
                    $payoutSetting->save();

                    $this->helper->one_time_message('success', "Updated Successfully");
                    return redirect('users/payout');
                }
              };
        }
    }

     public function delete(Request $request)
     {
        $withdrawal = Withdrawal::where(['payout_id' => $request->id])->get()->toArray();
        if (env('APP_MODE', '') != 'test') {
            if (count($withdrawal) > 0) {
              $this->helper->one_time_message('danger', 'This Account has Payouts Request. Sorry can not possible to delete');
            } else {
              PayoutSetting::find($request->id)->delete();
                $this->helper->one_time_message('success', trans('messages.success.delete_success'));
                return redirect('users/payout');
            }                    
        }
          return redirect('users/payout');  
      }

    public function payoutList(PayoutListDataTable $dataTable) 
    {
        $data['title']= 'Payouts';
        $data['from'] = isset(request()->from) ? request()->from : null;
        $data['to']   = isset(request()->to) ? request()->to : null;
    		
        $data['walletBalance'] = Wallet::where(['user_id' => Auth::user()->id])->first(); 
        $data['payouts'] = PayoutSetting::where(['user_id' => Auth::user()->id])->get();

        return $dataTable->render('payoutlists.view',$data);
    }
		
        public function success(Request $request)
        {
            $userId            = Auth::user()->id;
            $payoutSetting     = PayoutSetting::find($request->payment_method_id);
            $walletMoney       = Wallet::where('user_id', $userId)->first();

            $withdrawal                         = new Withdrawal;
            $withdrawal->user_id                = $userId;
            $withdrawal->currency_id            = $request->currency_id;
            $withdrawal->payout_id              = $request->payment_method_id;
            $withdrawal->payment_method_id      = $payoutSetting->type;
            $withdrawal->uuid                   = uniqid();
            $withdrawal->subtotal               = $request->amount;
            $withdrawal->email                  = $payoutSetting->email;
            $withdrawal->status                 = "Pending";
            
            $withdrawal->account_number         = $payoutSetting->account_number;
            $withdrawal->bank_name              = $payoutSetting->bank_name;
            $withdrawal->swift_code             = $payoutSetting->swift_code;

            if ($walletMoney->balance >= $withdrawal->subtotal) {
                $withdrawal->save();
                $this->helper->one_time_message('success', "Payout request successfully.");
                return redirect('users/payout-list');
            } else {
                $this->helper->one_time_message('error', " Sorry! You don't have sufficient balance.");
                return redirect('users/payout-list');
            }
        }
}
