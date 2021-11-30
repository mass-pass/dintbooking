<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\CountryDataTable;
use App\Http\Helpers\Common;
use App\Models\Country;
use Validator;

class CountryController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(CountryDataTable $dataTable)
    {
        return $dataTable->render('admin.countrys.view');
    }

    public function add(Request $request)
    {
        if (! $request->isMethod('post')) {
             return view('admin.countrys.add');
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'short_name'        => 'required|max:5',
                    'name'              => 'required|max:100',
                    'iso3'              => 'required|max:10',
                    'number_code'       => 'required|max:10',
                    'phone_code'        => 'required|max:10'
                    );

            
            $fieldNames = array(
                        'short_name'        => 'Short Name',
                        'name'              => 'Name',
                        'iso3'              => 'ISO3',
                        'number_code'       => 'Number Code',
                        'phone_code'        => 'Phone Code'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $country                = new Country;
                $country->short_name    = $request->short_name;
                $country->name          = $request->name;
                $country->iso3          = $request->iso3;
                $country->number_code   =$request->number_code;
                $country->phone_code    =$request->phone_code;
                $country->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/settings/country');
            }
        }
    }

    public function update(Request $request)
    {
        if (! $request->isMethod('post')) {
             $data['result'] = Country::find($request->id);

            return view('admin.countrys.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'short_name'        => 'required|max:5',
                    'name'              => 'required|max:100',
                    'iso3'              => 'required|max:10',
                    'number_code'       => 'required|max:10',
                    'phone_code'        => 'required|max:10'
                    );

            $fieldNames = array(
                        'short_name'        => 'Short Name',
                        'name'              => 'Name',
                        'iso3'              => 'ISO3',
                        'number_code'       => 'Number Code',
                        'phone_code'        => 'Phone Code'
                        );
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                if (env('APP_MODE', '') != 'test') {
                    $country  = Country::find($request->id);
                    $country->short_name     = $request->short_name;
                    $country->name           = $request->name;
                    $country->iso3           = $request->iso3;
                    $country->number_code    =$request->number_code;
                    $country->phone_code     =$request->phone_code;
                    $country ->save();
                }

                $this->helper->one_time_message('success', 'Updated Successfully');

                return redirect('admin/settings/country');
            }
        }
    }

    public function delete(Request $request)
    {
        if (env('APP_MODE', '') != 'test') {
            Country::find($request->id)->delete();
        }
        $this->helper->one_time_message('success', 'Deleted Successfully');
        return redirect('admin/settings/country');
    }
}
