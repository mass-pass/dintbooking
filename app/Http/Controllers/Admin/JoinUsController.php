<?php




namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\JoinUs;
use App\Http\Helpers\Common;
use Validator;

class JoinUsController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index(Request $request)
    {
        if ( !$request->isMethod('post') ) {
             $data['result'] = JoinUs::get();
            
            return view('admin.join_us', $data);
        } elseif ( $request->isMethod('post') ) {
            $rules = array(
                    'facebook'    => 'required',
                    'google_plus' => 'required',
                    'twitter'     => 'required',
                    'linkedin'    => 'required',
                    'pinterest'   => 'required',
                    'youtube'     => 'required',
                    'instagram'   => 'required'
                    );

            $fieldNames = array(
                        'facebook'    => 'Facebook',
                        'google_plus' => 'Google Plus',
                        'twitter'     => 'Twitter',
                        'linkedin'    => 'Linkedin',
                        'pinterest'   => 'Pinterest',
                        'youtube'     => 'Youtube',
                        'instagram'   => 'Instagram'
                        );

            $validator = Validator::make($request->all(), $rules);
            $validator->setAttributeNames($fieldNames);

            if ($validator->fails()) {
                return back()->withErrors($validator)->withInput();
            } else {
                if (env('APP_MODE', '') != 'test') {
                    JoinUs::where(['name' => 'facebook'])->update(['value' => $request->facebook]);
                    JoinUs::where(['name' => 'google_plus'])->update(['value' => $request->google_plus]);
                    JoinUs::where(['name' => 'twitter'])->update(['value' => $request->twitter]);
                    JoinUs::where(['name' => 'linkedin'])->update(['value' => $request->linkedin]);
                    JoinUs::where(['name' => 'pinterest'])->update(['value' => $request->pinterest]);
                    JoinUs::where(['name' => 'youtube'])->update(['value' => $request->youtube]);
                    JoinUs::where(['name' => 'instagram'])->update(['value' => $request->instagram]);
                }
                
                $this->helper->one_time_message('success', 'Updated Successfully');
            
                return redirect('admin/join_us');
            }
        } else {
            return redirect('admin/join_us');
        }
    }
}
