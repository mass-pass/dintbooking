<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Helpers\Common;
use App\Http\Controllers\Controller;
use App\DataTables\CurrencyDataTable;
use App\Models\Currency;
use Validator;

class CurrencyController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(CurrencyDataTable $dataTable)
    {
        return $dataTable->render('admin.currencys.view');
    }
    
    public function add(Request $request)
    {
        if (! $request->isMethod('post')) {
            return view('admin.currencys.add');
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'name'           => 'required|max:50',
                    'code'           => 'required|unique:currency|max:10',
                    'symbol'         => 'required|max:10',
                    'rate'           => 'required|numeric',
                    'status'         => 'required'
                    );

            $fieldNames = array(
                        'name'              => 'Name',
                        'code'              => 'Code',
                        'symbol'            => 'Symbol',
                        'rate'              => 'Rate',
                        'status'            => 'Status'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $currency               = new Currency;
                $currency->name         = $request->name;
                $currency->code         = $request->code;
                $currency->symbol       = $request->symbol;
                $currency->rate         = $request->rate;
                $currency->status       = $request->status;
                $currency->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/settings/currency');
            }
        }
    }

    public function update(Request $request)
    {
        if (!$request->isMethod('post')) {
            $data['result'] = Currency::find($request->id);
            return view('admin.currencys.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'name'           => 'required|default_home_currency',
                    'code'           => 'required',
                    'symbol'         =>'required',
                    'rate'           =>'required',
                    'status'         => 'required'
                    );

            $fieldNames = array(
                        'name'              => 'Name',
                        'code'              => 'Code',
                        'symbol'            => 'Symbol',
                        'rate'              => 'Rate',
                        'status'            => 'Status'
                        );
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                if (env('APP_MODE', '') != 'test') {
                    $currency= Currency::find($request->id);
                    $currency->name         = $request->name;
                    $currency->code         = $request->code;
                    $currency->symbol       = $request->symbol;
                    $currency->rate         = $request->rate;
                    $currency->status       = $request->status;
                    $currency->save();
                }
                
                $this->helper->one_time_message('success', 'Updated Successfully');

                return redirect('admin/settings/currency');
            }
        }
    }

    public function delete(Request $request)
    {
        if (env('APP_MODE', '') != 'test') {
            Currency::find($request->id)->delete();
        }

        $this->helper->one_time_message('success', 'Deleted Successfully');

        return redirect('admin/settings/currency');
    }
}
