<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\AmenityTypeDataTable;
use App\Models\AmenityType;
use Validator;
use App\Http\Helpers\Common;

class AmenitiesTypeController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(AmenityTypeDataTable $dataTable)
    {
        return $dataTable->render('admin.amenityTypes.view');
    }

    public function add(Request $request)
    {
        
        $info = $request->isMethod('post');
        if (! $info) {
             return view('admin.amenityTypes.add');
        } elseif ($info) {
            $rules = array(
                    'name'           => 'required|max:50',
                    'description'    => 'required|max:100'
                    );

            $fieldNames = array(
                        'name'              => 'Name',
                        'description'       => 'Description'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $amenityType = new AmenityType;
                $amenityType->name           = $request->name;
                $amenityType->description    = $request->description;
                $amenityType->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/settings/amenities-type');
            }
        }
    }
    public function update(Request $request)
    {
        $info = $request->isMethod('post');
        if (! $info) {
             $data['result'] = AmenityType::find($request->id);

            return view('admin.amenityTypes.edit', $data);
        } elseif ($info) {
            $rules = array(
                    'name'         => 'required|max:50',
                    'description'  => 'required|max:100'
                    );

            $fieldNames = array(
                        'name'            => 'Name',
                        'description'     => 'Description'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $amenityType = AmenityType::find($request->id);
                 $amenityType->name           = $request->name;
                 $amenityType->description    = $request->description;
                 $amenityType->save();
                $this->helper->one_time_message('success', 'Updated Successfully');
                return redirect('admin/settings/amenities-type');
            }
        }
    }

    public function delete(Request $request)
    {
        AmenityType::find($request->id)->delete();

        $this->helper->one_time_message('success', 'Deleted Successfully');
        return redirect('admin/settings/amenities-type');
    }
}
