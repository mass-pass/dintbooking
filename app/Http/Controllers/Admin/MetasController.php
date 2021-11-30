<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\DataTables\MetasDataTable;
use App\Models\Meta;
use Validator;
use App\Http\Helpers\Common;

class MetasController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(metasDataTable $dataTable)
    {
        return $dataTable->render('admin.metas.view');
    }
    
    public function add(Request $request)
    {
        if (!$request->isMethod('post')) {
            return view('admin.metas.add');
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'title'          => 'required|max:255',
                    'url'            => 'required|max:255',
                    'description'    => 'required',
                    'keywords'       => 'required'
                    );

            $fieldNames = array(
                        'title'         => 'Title',
                        'url'           => 'Url',
                        'description'   => 'Description',
                        'keywords'      => 'Keywords'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $user = new Metas;
                $metas->url          = $request->url;
                $metas->title        = $request->title;
                $metas->description  = $request->description;
                $metas->keywords     = $request->keywords;
                $user->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/metas');
            }
        }
    }

    public function update(Request $request)
    {
        if (! $request->isMethod('post')) {
             $data['result'] = Meta::find($request->id);

            return view('admin.metas.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                'url'           => 'required|max:255',
                'title'         => 'required|max:255',
                'description'   => 'required',
                );

            $fieldNames = array(
                    'url'              => 'Url',
                    'title'            =>'Title',
                    'description'      => 'Description',
                    'keywords'         => 'Keywords'
                    );
            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $metas  = Meta::find($request->id);
                $metas ->url          = $request->url;
                $metas ->title        = $request->title;
                $metas ->description  = $request->description;
                $metas ->keywords     = $request->keywords;
                $metas ->save();


                $this->helper->one_time_message('success', 'Updated Successfully');

                return redirect('admin/settings/metas');
            }
        }
    }

    public function delete(Request $request)
    {
        Metas::find($request->id)->delete();

        $this->helper->one_time_message('success', 'Deleted Successfully');

        return redirect('admin/users');
    }
}
