<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PropertyTypeDataTable;
use App\Models\PropertyType;
use Validator;
use App\Http\Helpers\Common;

class PropertyTypeController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(PropertyTypeDataTable $dataTable)
    {
        return $dataTable->render('admin.propertyTypes.view');
    }
    
    public function add(Request $request)
    {
        if (! $request->isMethod('post')) {
            return view('admin.propertyTypes.add');
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'name'           => 'required|max:100',
                    'description'    => 'required|max:255',
                    'status'         => 'required'
                    );

            $fieldNames = array(
                        'name'              => 'Name',
                        'description'       => 'Description',
                        'status'            => 'Status'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $propertyType                = new PropertyType;
                $propertyType->name          = $request->name;
                $propertyType->description   = $request->description;
                $propertyType->status        = $request->status;
                $propertyType->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/settings/property-type');
            }
        }
    }

    public function update(Request $request)
    {
        if (! $request->isMethod('post')) {
             $data['result'] = PropertyType::find($request->id);

            return view('admin.propertyTypes.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'name'           => 'required|max:110',
                    'description'    => 'required|max:255',
                    'status'         => 'required'
                    );

            $fieldNames = array(
                        'name'              => 'Name',
                        'description'       => 'Description',
                        'status'            => 'Status'
                        );
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $propertyType  = PropertyType::find($request->id);

                $propertyType->name          = $request->name;
                $propertyType->description   = $request->description;
                $propertyType->status        = $request->status;
                $propertyType->save();


                $this->helper->one_time_message('success', 'Updated Successfully');

                return redirect('admin/settings/property-type');
            }
        }
    }

    public function delete(Request $request)
    {
        PropertyType::find($request->id)->delete();

        $this->helper->one_time_message('success', 'Deleted Successfully');

        return redirect('admin/settings/property-type');
    }
}
