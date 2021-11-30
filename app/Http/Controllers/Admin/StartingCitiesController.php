<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\StartingCitiesDataTable;
use App\Models\StartingCities;
use Validator;
use App\Http\Helpers\Common;


class StartingCitiesController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(StartingCitiesDataTable $dataTable)
    {
        return $dataTable->render('admin.startingCities.view');
    }


    public function add(Request $request)
    {
        if (! $request->isMethod('post')) {
            return view('admin.startingCities.add');
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'name'    => 'required|max:100',
                    'image'   => 'required|dimensions:min_width=640,min_height=360,ratio=16/9',
                    'status'  =>'required'
                    );

            $fieldNames = array(
                        'name'    => 'Starting City Name',
                        'image'   => 'Image',
                        'status'  =>'Status'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);


            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $image     =   $request->file('image');
                $extension =   $image->getClientOriginalExtension();
                $filename  =   'starting_city_'.time() . '.' . $extension;

                $success = $image->move('front/images/starting_cities', $filename);
        
                if (! $success) {
                    return back()->withError('Could not upload Image');
                }

                $starting_cities = new StartingCities;

                $starting_cities->name  = $request->name;
                $starting_cities->image = $filename;
                $starting_cities->status=$request->status;

                $starting_cities->save();

                $this->helper->vrCacheForget('vr-cities');

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/settings/starting-cities');
            }
        } else {
            return redirect('admin/settings/starting-cities');
        }
    }

    public function update(Request $request)
    {
        if (! $request->isMethod('post')) {
             $data['result'] = StartingCities::find($request->id);

             return view('admin.startingCities.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                'name'    => 'required|max:100',
                'image'   => 'dimensions:min_width=640,min_height=360,ratio=16/9',
                'status'  =>'required'
                );

            $fieldNames = array(
                    'name'    => 'Starting City Name',
                    'image'   => 'Image',
                    'status'  =>'Status'
                    );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $starting_cities =StartingCities::find($request->id);

                $starting_cities->name  = $request->name;
                $starting_cities->status=$request->status;


                $image     =   $request->file('image');

                if ($image) {
                    $extension =   $image->getClientOriginalExtension();
                    $filename  =   'starting_city_'.time() . '.' . $extension;
    
                    $success   = $image->move('front/images/starting_cities', $filename);
        
                    if (! $success) {
                         return back()->withError('Could not upload Image');
                    }

                    $starting_cities->image = $filename;
                }

                $starting_cities->save();

                $this->helper->vrCacheForget('vr-cities');

                $this->helper->one_time_message('success', 'Updated Successfully');
                return redirect('admin/settings/starting-cities');
            }
        } else {
            return redirect('admin/settings/starting-cities');
        }
    }

    public function delete(Request $request)
    {
        if (env('APP_MODE', '') != 'test') {
            $starting_cities = StartingCities::find($request->id);
            $file_path       = public_path().'/front/images/starting_cities/'.$starting_cities->image;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            StartingCities::find($request->id)->delete();

            $this->helper->vrCacheForget('vr-cities');

            $this->helper->one_time_message('success', 'Deleted Successfully');
        }
        
        return redirect('admin/settings/starting-cities');
    }
}
