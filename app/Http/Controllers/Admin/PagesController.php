<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\DataTables\PagesDataTable;
use App\Models\Page;
use Validator;
use App\Http\Helpers\Common;
use Illuminate\Support\Facades\Input;

class PagesController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }
    
    public function index(PagesDataTable $dataTable)
    {
        return $dataTable->render('admin.pages.view');
    }
    
    public function add(Request $request)
    {
        if (! $request->isMethod('post')) {
             return view('admin.pages.add');
        } elseif ($request->isMethod('post')) {
            $rules = array(
                    'name'           => 'required|max:100',
                    'url'            => 'required|unique:pages|max:100',
                    'content'        => 'required',
                    'position'       => 'required|max:40'
                    );

            $fieldNames = array(
                        'name'              => 'Name',
                        'url'               => 'Url',
                        'content'           => 'Content',
                        'position'          => 'Position'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {


                $page = new Page;
                $page->name             = $request->name;
                $page->url              = $request->url;
                $page->content          = $request->content;
                $page->position         = $request->position;
                $page->status           = $request->status;

                $page->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/pages');
            }
        }
    }

    public function update(Request $request)
    {
        if (!$request->isMethod('post')) {
            $data['result'] = Page::find($request->id);

            return view('admin.pages.edit', $data);
        } else if ($request->isMethod('post')) {
            $rules = array(
                    'name'           => 'required|max:100',
                    'url'            => 'required|max:100',
                    'content'        => 'required',
                    'position'       => 'required|max:40'
                    );

            $fieldNames = array(
                        'name'          => 'Name',
                        'url'           => 'Url',
                        'content'       => 'Content',
                        'position'      => 'Position'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $page = Page::find($request->id);

                $page->name            = $request->name;
                $page->url             = $request->url;
                $page->content         = $request->content;
                $page->position        = $request->position;
                $page->status          = $request->status;
                $page->save();

                $this->helper->one_time_message('success', 'Updated Successfully');

                return redirect('admin/pages');
            }
        }
    }

    public function delete(Request $request)
    {
        Page::find($request->id)->delete();

        $this->helper->one_time_message('success', 'Deleted Successfully');

        return redirect('admin/pages');
    }
    public function uploadImage(Request $request)
    { 
        $CKEditor = $request->input('CKEditor');
        $funcNum  = $request->input('CKEditorFuncNum');
        $message  = $url = '';
        if (Input::hasFile('upload')) {
            $file = Input::file('upload');

            if ($file->isValid()) {

                $filename =rand(1000,9999).$file->getClientOriginalName();

                $file->move(public_path().'/images/', $filename);
                $url = url('images/' . $filename);

            } else {
                $message = 'An error occurred while uploading the file.';
            }
        } else {
            $message = 'No file uploaded.';
        }
        return '<script>window.parent.CKEDITOR.tools.callFunction('.$funcNum.', "'.$url.'", "'.$message.'")</script>';
    }
}
