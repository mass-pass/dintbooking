<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DataTables\LanguageDataTable;
use App\Models\Language;
use App\Http\Helpers\Common;
use Validator;

class LanguageController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(LanguageDataTable $dataTable)
    {
        return $dataTable->render('admin.language.view');
    }

    public function add(Request $request)
    {
        if ( !$request->isMethod('post') ) {
            return view('admin.language.add');
        } elseif ( $request->isMethod('post') ) {
            $rules = array(
                    'name'        => 'required|unique:language',
                    'short_name'  => 'required|unique:language',
                    'status'      => 'required'
                    );

            $fieldNames = array(
                    'name'         => 'Name',
                    'short_name'   => 'Short Name',
                    'status'       => 'Status'
                );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                if (env('APP_MODE', '') != 'test') {
                    $language = new Language;
                    $language->name        = $request->name;
                    $language->short_name  = $request->short_name;
                    $language->status      = $request->status;
                    $language->save();
                }

                $this->helper->one_time_message('success', 'Added Successfully');

                return redirect('admin/settings/language');
            }
        } else {
            return redirect('admin/settings/language');
        }
    }

    public function update(Request $request)
    {
        if ( !$request->isMethod('post') ) {
            $data['result'] = Language::find($request->id);

            return view('admin.language.edit', $data);
        } elseif ( $request->isMethod('post') ) {
            $rules = array(
                    'name'        => 'required|default_home_language|unique:language,name,'.$request->id,
                    'short_name'  => 'required|unique:language,short_name,'.$request->id,
                    'status'      => 'required'
                    );

            $fieldNames = array(
                        'name'         => 'Name',
                        'short_name'   => 'Short Name',
                        'status'       => 'Status'
                    );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                if (env('APP_MODE', '') != 'test') {
                    $language = Language::find($request->id);
                    $language->name        = $request->name;
                    $language->short_name  = $request->short_name;
                    $language->status      = $request->status;
                    $language->save();
                }

                $this->helper->one_time_message('success', 'Updated Successfully');

                return redirect('admin/settings/language');
            }
        } else {
            return redirect('admin/settings/language');
        }
    }

    public function delete(Request $request)
    {
        if (env('APP_MODE', '') != 'test') {
            Language::find($request->id)->delete();
        }

        $this->helper->one_time_message('success', 'Deleted Successfully');

        return redirect('admin/settings/language');
    }
}
