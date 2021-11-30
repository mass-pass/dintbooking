<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AmenitiesDataTable;
use App\Models\Amenities;
use App\Models\AmenityType;
use Validator;
use App\Http\Helpers\Common;

class AmenitiesController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(AmenitiesDataTable $dataTable)
    {
        return $dataTable->render('admin.amenities.view');
    }

    public function add(Request $request)
    {
        $info = $request->isMethod('post');
        if (! $info) {
            $amenity_type=AmenityType::get();
            $am = [];
            foreach ($amenity_type as $key => $value) {
                $am[$value->id]=$value->name;
            }
            $data['am'] = $am;
            return view('admin.amenities.add', $data);
        } elseif ($info) {
            $rules = array(
                    'title'          => 'required|max:50',
                    'description'    => 'required|max:100',
                    'symbol'         => 'required|max:50',
                    'type_id'        => 'required',
                    'status'         => 'required'

                    );

            $fieldNames = array(
                        'title'             => 'Title',
                        'description'       => 'Description',
                        'symbol'            => 'Symbol'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $amenitie = new Amenities;
                $amenitie->title            = $request->title;
                $amenitie->description    = $request->description;
                $amenitie->symbol           = $request->symbol;
                $amenitie->type_id        = $request->type_id;
                $amenitie->status         = $request->status;
                $amenitie->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/amenities');
            }
        }
    }
    public function update(Request $request)
    {
        $info = $request->isMethod('post');
        if (! $info) {
               $amenity_type=AmenityType::get();
               $am = [];
            foreach ($amenity_type as $key => $value) {
                 $am[$value->id]=$value->name;
            }
              $data['am']   = $am;
            $data['result'] = Amenities::find($request->id);
            return view('admin.amenities.edit', $data);
        } elseif ($info) {
            $rules = array(
                    'title'          => 'required|max:50',
                    'description'    => 'required|max:100',
                    'symbol'         => 'required|max:50',
                    'type_id'        => 'required',
                    'status'         => 'required'

                    );

            $fieldNames = array(
                        'title'             => 'Title',
                        'description'       => 'Description',
                        'symbol'            => 'Symbol'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $amenitie = Amenities::find($request->id);
                $amenitie->title          = $request->title;
                $amenitie->description    = $request->description;
                $amenitie->symbol         = $request->symbol;
                $amenitie->type_id        = $request->type_id;
                $amenitie->status         = $request->status;
                $amenitie->save();

                $this->helper->one_time_message('success', 'Updated Successfully');
                return redirect('admin/amenities');
            }
        }
    }

    public function delete(Request $request)
    {
        Amenities::find($request->id)->delete();
        $this->helper->one_time_message('success', 'Deleted Successfully');
        return redirect('admin/amenities');
    }
}
