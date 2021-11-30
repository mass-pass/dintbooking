<?php



namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\EmailTemplate;


use Validator;
use App\Http\Helpers\Common;

class EmailTemplateController extends Controller
{
    protected $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index($id)
    {
        $data['list_menu']  = 'menu-'.$id;
        $data['tempId']     = $id;
        $data['temp_Data']  = EmailTemplate::with(['language' => function ($query) {
            $query->where(['status'=>'Active']);
        }])->where(['type' => 'email','temp_id'=>$id])->get();

        $data['languages'] = Language::where(['language.status'=>'Active'])->orderBy('id')->get();

        return view('admin.emailTemplates.view', $data);
    }

    public function update(Request $request, $id)
    {
       
        unset($request['_wysihtml5_mode']);
        unset($request['_token']);

        foreach ($request->all() as $key => $value) {
            $lang[] = $key;
            $lang_id[] = $value['id'];
            unset($value['id']);
            $data[] = $value;
        }
        
        for ($i=0; $i < count($lang_id); $i++) {
            $check = EmailTemplate::where('lang_id', '=', $lang_id[$i])
                                    ->where('temp_id', '=', $id)
                                    ->where('type', '=', 'email')
                                    ->first();
            if ($check) {
                $templateToUpdate = EmailTemplate::where([['temp_id',$id],['lang_id', $lang_id[$i]],['type','email']])->first();
                $templateToUpdate->subject  = $data[$i]['subject'];
                $templateToUpdate->body     = $data[$i]['body'];
                $templateToUpdate->save();
            } else {
                $newTemplate = new EmailTemplate;
                $newTemplate->temp_id   = $id;
                $newTemplate->subject   = $data[$i]['subject'];
                $newTemplate->body      = $data[$i]['body'];
                $newTemplate->lang      = $lang[$i];
                $newTemplate->type      = 'email';
                $newTemplate->lang_id   = $lang_id[$i];
                $newTemplate->save();
            }
        }
        $this->helper->one_time_message('success', 'Updated Successfully');
        return redirect()->intended("admin/email-template/$id");
    }
}
