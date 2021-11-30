<?php


namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\DataTables\BannersDataTable;
use App\Models\Banners;
use App\Http\Helpers\Common;
use Validator;

use Storage, Image;

class BannersController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(BannersDataTable $dataTable)
    {
        return $dataTable->render('admin.banners.view');
    }

    public function add(Request $request)
    {
        if (!$request->isMethod('post')) {
            return view('admin.banners.add');
        } elseif ($request->isMethod('post')) {
            $rules = array(
                'heading'    => 'required|max:100',
                'image'      => 'required|dimensions:min_width=1920,min_height=860'
            );

            $fieldNames = array(
                'heading'    => 'Heading',
                'image'      => 'Image'
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $_image     =   $request->file('image');
                $extension =   $_image->getClientOriginalExtension();
                $image = Image::make($_image);
                $filename  =   'banner_' . time() . '.' . $extension;

                $path = 'images/common/' . $filename;
                $height = $image->height();
                $width = $image->width();
                if ($height > 860) {
                    if (ceil(2.23 * 860) < $width) {
                        $height = 860;
                        $width = ceil(2.23 * $height);
                    }
                }

                $calculated_width = ceil((16 / 9) * $height);
                $calculated_height = ceil($width / (16 / 9));
                $applicable_height = 0;
                $applicable_width = 0;

                if ($height >= $calculated_height) {
                    $applicable_height = $calculated_height;
                    $applicable_width = $width;
                } else {
                    $applicable_height = $height;
                    $applicable_width = $calculated_width;
                }

                $image->fit($applicable_width, $applicable_height)->encode($extension, 60);

                //Storage::disk('s3')->put($path, $image->stream(), 'public');

                Storage::put($path, $image->stream(), 'public');

                $banners = new Banners;

                $banners->heading  = $request->heading;
                $banners->image    = $filename;
                $banners->status   = $request->status;
                if (isset($request->subheading)) {
                    $banners->subheading = $request->subheading;
                }
                $banners->save();

                $this->helper->one_time_message('success', 'Added Successfully');
                return redirect('admin/settings/banners');
            }
        } else {
            return redirect('admin/settings/banners');
        }
    }
    public function update(Request $request)
    {
        if (!$request->isMethod('post')) {
            $data['result'] = Banners::find($request->id);

            return view('admin.banners.edit', $data);
        } elseif ($request->isMethod('post')) {
            $rules = array(
                'heading'    => 'required|max:100',
                'image'      => 'dimensions:min_width=1920,min_height=860'

            );

            $fieldNames = array(
                'heading'    => 'Heading',
                'image'      => 'dimensions:min_width=1920,min_height=860'
            );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                $banners = Banners::find($request->id);

                $banners->heading  = $request->heading;
                $banners->status   = $request->status;
                if (isset($request->subheading)) {
                    $banners->subheading = $request->subheading;
                }
                $_image     =   $request->file('image');

                if ($_image) {
                    $extension =   $_image->getClientOriginalExtension();
                    $image = Image::make($_image);
                    $filename  =   'banner_' . time() . '.' . $extension;

                    $path = 'images/common/' . $filename;
                    $height = $image->height();
                    $width = $image->width();
                    if ($height > 860) {
                        if (ceil(2.23 * 860) < $width) {
                            $height = 860;
                            $width = ceil(2.23 * $height);
                        }
                    }

                    $calculated_width = ceil((16 / 9) * $height);
                    $calculated_height = ceil($width / (16 / 9));
                    $applicable_height = 0;
                    $applicable_width = 0;

                    if ($height >= $calculated_height) {
                        $applicable_height = $calculated_height;
                        $applicable_width = $width;
                    } else {
                        $applicable_height = $height;
                        $applicable_width = $calculated_width;
                    }

                    $image->fit($applicable_width, $applicable_height)->encode($extension, 60);

                    //Storage::disk('s3')->put($path, $image->stream(), 'public');
                    Storage::put($path, $image->stream(), 'public');

                    $banners->image = $filename;
                }

                $banners->save();

                $this->helper->one_time_message('success', 'Updated Successfully');
                return redirect('admin/settings/banners');
            }
        } else {
            return redirect('admin/settings/banners');
        }
    }
    public function delete(Request $request)
    {
        if (env('APP_MODE', '') != 'test') {
            $banners   = Banners::find($request->id);
            $file_path = public_path() . '/front/images/banners/' . $banners->image;
            if (file_exists($file_path)) {
                unlink($file_path);
            }
            Banners::find($request->id)->delete();
            $this->helper->one_time_message('success', 'Deleted Successfully');
        }

        return redirect('admin/settings/banners');
    }
}
