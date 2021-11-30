<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Common;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\Comment;
use App\Models\Category;
use App\Models\CategoryPhoto;
use App\Models\Follow;
use App\Models\Payment;

class CommentController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function get_comments(Request $request)
    {
        $photo   = Photo::where('id', $request->photo_id)->first();
        $details = $this->helper->key_value('field', 'value', $photo->photo_details);
        $photo->view_count = $photo->view_count+1;
        $photo->save();

        $photo_category = $photo->photo_categories;
        $category_str = '';
        $follow_str = '<button type="button" id="follow" data-rel="'.$photo->user_id.'" class="btn btn-pinkbg">Follow</button>';
        if (\Auth::check()) {
            if ($photo->user_id == \Auth::user()->id) {
                $follow_str = '';
            } else {
                $following = Follow::where('user_id', \Auth::user()->id)->get()->toArray();
                $follow_list = $this->helper->key_value('id', 'follow_id', $following);
                if (in_array($photo->user_id, $follow_list)) {
                    $follow_str = '<button type="button" id="follow" data-rel="'.$photo->user_id.'" class="btn btn-pinkbg">Following</button>';
                }
            }
        }


        foreach ($photo_category as $value) {
            $category_str .= '#'.$value->category->name.' &nbsp;';
        }
        $cont  = '<div class="turnBox">
        <div class="pull-left"><i class="fa fa-chevron-right fa-2" aria-hidden="true"></i></div>
      <div class="pull-left share_iconDiv">
      <div class="share_D">
        <a href="https://www.facebook.com/sharer/sharer.php?u='.url('photo/single/'.$request->photo_id).'" target="_blank"><img src="'.url('front/img/icon/facebook-icon.png').'" alt="" style="margin-right:1%;"/></a>
        <a href="http://twitter.com/share?url='.url('photo/single/'.$request->photo_id).'&text='.$photo->title.'" target="_blank""><img src="'.url('front/img/icon/twitter-icon.png').'" alt="" style="margin-right:1%;"/></a>
        <a href="mailto:?Subject='.$photo->title.'&Body='.$photo->description.' '.url('photo/single/'.$request->photo_id).'"><img src="'.url('front/img/icon/email.png').'" alt=""/></a>
        </div>
      </div>
      <div class="pull-right"><i class="fa fa-share-square-o fa-2" aria-hidden="true"></i></div>
      <div class="clearfix"></div>
      </div>';
        $cont .= '<div class="user-comments">
          <div>
             <div class="use-img media-photo-badge">
               <img class="img-responsive" src="'.$photo->users->profile_src.'" alt="">
             </div>
             <div class="comt">
             <div class="pull-left">
                <div class="user-heading pinkColor"><strong><a target="_blank" href="'.url('profile/'.$photo->user_id).'">'.ucfirst($photo->users->name).'</a></strong></div>
                <div class="lightColor">'.date('d F Y', strtotime($photo->created_at)).'</div>
                </div>
               <div class="follow-btn pull-right">'.$follow_str.'</div>
             </div>
          </div>
          <div class="clearfix"></div>
          <div class="mtop10">
              <div class="inblk marginRt"><strong>'.$photo->title.'</strong></div>
              <div class="inblk marginRt"><i class="fa fa-eye" aria-hidden="true"></i> '.$this->helper->thousandsCurrencyFormat($photo->view_count).'</div>
              <div class="inblk "><a href="javascript:void(0)" class="feed-love" data-rel="'.$photo->id.'"><i class="fa fa-heart" aria-hidden="true"></i>&nbsp;<span id="love_num">'.$this->helper->thousandsCurrencyFormat($photo->love_count).'</span></a></div>
          </div>
          <div class="mtop10">
          <div class="inblk marginRt">'.$photo->description.'</div>
              <div class="markText pinkColor">'.$category_str.'</div>
          </div>
          <hr>';
          $comment_count = 1;
          $cont .= '<div id="comment-div">';
        foreach ($photo->comments as $key => $value) {
            $delete_div = '';
            if (\Auth::check() && $value->user_id == \Auth::user()->id) {
                $delete_div = '<div class="pull-right"><a href="javascript:void(0)" class="cmnt-del" data-rel="'.$value->id.'">'.trans('messages.utility.delete').'</a></div>';
            }
            $cont .= '<div class="mtop20" id="dv-cmnt-'.$value->id.'">
                          <div class="use-img media-photo-badge">
                              <img class="img-responsive" src="'.$value->users->profile_src.'" alt="">
                          </div>
                          <div class="comt">
                             <div class="pull-left wd100">
                                <div class="user-heading"><strong class="pinkColor"><a target="_blank" href="'.url('profile/'.$value->user_id).'">'.ucfirst($value->users->name).'</a></strong>&nbsp;<span class="h5"> '.$value->comment.'</span></div>
                                <div class="chonOption">
                                   <ul>
                                      <li>'.date('d F Y', strtotime($value->created_at)).$delete_div.'</li>
                                   </ul>
                                </div>
                              </div>
                          </div>
                     </div><div class="clearfix"></div>';
            if ($comment_count == 3) {
                break;
            }
            $comment_count++;
        }

          $cont .= '<div id="cmnt-append"></div>';
          $cont .= '</div>';
        if ($photo->comments->count() > 3) {
            $cont .= '<div class="mtop20 pinkColor" style="text-align:center;"><a id="load-more-comment" href="javascript:void(0)">'.trans('messages.utility.load_more').'</a></div>';
        }
        if (\Auth::check()) {
            $cont .= '<div class="mtop20">
                  <div class="use-img media-photo-badge">
                      <a href="#"><img alt="" class="img-responsive" src="'.$photo->users->profile_src.'"></a>
                  </div>
                  <div class="comt">
                      <div class="dialogbox">
                        <div class="message">
                          <textarea class="feed-comment" data-rel="'.$photo->id.'" style="padding: 5px;background-color: #eee; border: 1px;border-radius: 0;" rows="2" cols="30" placeholder="'.trans('messages.utility.just_made_a_comment').'"></textarea>
                        </div>
                      </div>
                  </div>  
              </div>
        <div class="clearfix"></div>';
        }
      
        if (isset($details['longitude'])) {
            $cont .= '<div class="mtop20">
          <h3>'.trans('messages.utility.location').'</h3>
          <div class="map">
            <div id="us3" style="width: 360px; height: 220px;"></div>
          </div>
       
          <input type="hidden" class="form-control" name="longitude" id="us3-lat" placeholder="" value="'.$details['longitude'].'">
          <input type="hidden" class="form-control" name="latitude" id="us3-lon" placeholder="" value="'.$details['latitude'].'">  
        </div>';
        }

        $camera_fields = ['camera', 'lens_model', 'shutter_speed', 'aperture', 'focal_length', '35mm_equivalent', 'iso'];
      
        if (isset($details['camera'])) {
            $cont .= '<div class="mtop20">
                  <h3>'.trans('messages.utility.more_details').'</h3>';
            foreach ($details as $key => $value) {
                if (in_array($key, $camera_fields)) {
                    $cont .= '<div class="col-md-6">'.ucfirst(str_replace('_', ' ', $key)).'</div>
            <div class="col-md-6">'.$value.'</div>';
                }
            }
            $cont .= '</div>';
        }
        $cont .='<div class="mtop20 link-report" style="text-align:center;"><a id="report_modal" href="javascript:void(0)">'.trans('messages.utility.report_this_photo').'</a></div>';
        $cont .='<div>&nbsp;</div>';

        $bought_photo = 0;
        if (\Auth::check()) {
            $bought_photo = Payment::where('photo_id', $request->photo_id)->where('user_id', \Auth::user()->id)->count();
        }
      
        if ($photo->sell_photo == 'Yes' && !$bought_photo) {
            $cont .= '<div class="buy-div" style="position: fixed;bottom: 2px;z-index:99999;"><a href="'.url('payments/buy/'.$request->photo_id).'" style="color:white;" class="btn btn-block btn-pinkbg" type="button">'.trans('messages.utility.buy').'('.\Session::get('symbol').$photo->price.')</a></div>';
        } else {
            $cont .= '<form method="post" action="'.url('photos/download').'/'.$request->photo_id.'">
                    <div class="buy-div" style="position: fixed;bottom: 2px;z-index:99999;">
                      <input name="download" type="submit" class="btn btn-block btn-pinkbg" value="'.trans('messages.utility.download').'">
                    </div>
                  </form>';
        }
        $cont .= '</div>';

        $data['success'] = 1;
        $data['comments'] = $cont;
        $data['view_count'] = $photo->view_count;
        echo json_encode($data);
    }

    public function get_only_comments(Request $request)
    {
      
        $comments = Comment::where('photo_id', $request->photo_id)->get();

        $cont = '';
        foreach ($comments as $key => $value) {
            $delete_div = '';
            if (\Auth::check() && $value->user_id == \Auth::user()->id) {
                $delete_div = '<div class="pull-right"><a href="javascript:void(0)" class="cmnt-del" data-rel="'.$value->id.'">'.trans('messages.utility.delete').'</a></div>';
            }
            $cont .= '<div class="mtop20" id="dv-cmnt-'.$value->id.'">
                    <div class="use-img media-photo-badge">
                        <a href="#"><img class="img-responsive" src="'.$value->users->profile_src.'" alt=""></a>
                    </div>
                    <div class="comt">
                       <div class="pull-left wd100">
                          <div class="user-heading"><strong class="pinkColor"><a target="_blank" href="'.url('profile/'.$value->users->id).'">'.ucfirst($value->users->name).'</a></strong>&nbsp;&nbsp;<span class="h5"> '.$value->comment.'</span></div>
                          <div class="chonOption">
                             <ul>
                                <li>'.date('d F Y', strtotime($value->created_at)).$delete_div.'</li>
                             </ul>
                          </div>
                        </div>
                    </div>
               </div><div class="clearfix"></div>';
        }

        $data['success'] = 1;
        $data['comments'] = $cont;
        echo json_encode($data);
    }

    public function get_only_comment_feed(Request $request)
    {
     
        $comments = Comment::where('photo_id', $request->photo_id)->get();

        $cont = '';
        foreach ($comments as $key => $value) {
            $delete_div = '';
            if (\Auth::check() && $value->user_id == \Auth::user()->id) {
                $delete_div = '<div class="pull-right"><a href="javascript:void(0)" class="cmnt-del" data-rel="'.$value->id.'">'.trans('messages.utility.delete').'</a></div>';
            }
            $cont .= '<div class="mtop20" id="dv-cmnt-'.$value->id.'">
                    <div class="use-img-feed media-photo-badge">
                        <a href="#"><img class="img-responsive" src="'.$value->users->profile_src.'" alt=""></a>
                    </div>
                    <div class="comt">
                       <div class="pull-left wd100">
                          <div class="user-heading"><strong class="pinkColor"><a target="_blank" href="'.url('profile/'.$value->users->id).'">'.ucfirst($value->users->name).'</a></strong>&nbsp;&nbsp;<span class="h5"> '.$value->comment.'</span></div>
                          <div class="chonOption">
                             <ul>
                                <li>'.date('d F Y', strtotime($value->created_at)).$delete_div.'</li>
                             </ul>
                          </div>
                        </div>
                    </div>
               </div><div class="clearfix"></div>';
        }

        $data['success'] = 1;
        $data['comments'] = $cont;
        echo json_encode($data);
    }

    public function save_comments(Request $request)
    {
        $comment = $request->comment;
        $status = 0;
        $result = '';
        if ($comment != '') {
            $cmnt = new Comment;
            $cmnt->user_id  = \Auth::user()->id;
            $cmnt->photo_id = $request->photo_id;
            $cmnt->comment  = $comment;
            $cmnt->save();
            $status = 1;
            $delete_div = '<div class="pull-right"><a href="javascript:void(0)" class="cmnt-del" data-rel="'.$cmnt->id.'">'.trans('messages.utility.delete').'</a></div>';
            $result .= '<div class="mtop20" id="dv-cmnt-'.$cmnt->id.'">
                  <div class="use-img media-photo-badge">
                      <img class="img-responsive" src="'.\Auth::user()->profile_src.'" alt="">
                  </div>
                  <div class="comt">
                     <div class="pull-left wd100">
                        <div class="user-heading"><strong class="pinkColor">'.ucfirst($cmnt->users->name).'</strong>&nbsp;<span class="h5"> '.$cmnt->comment.'</span></div>
                        <div class="chonOption">
                           <ul>
                              <li>'.date('d F Y', strtotime($cmnt->created_at)).$delete_div.'</li>
                           </ul>
                        </div>
                      </div>
                  </div>
                </div><div class="clearfix"></div>';
        }
        $photo = Photo::where('id', $request->photo_id)->first();
        $notification = trans('messages.notification.commented', ['profile_url' => url('profile/'.\Auth::user()->id), 'user_name' => ucfirst(\Auth::user()->name), 'photo_url' => url('photo/single/'.$request->photo_id)]);

        $this->helper->add_notification($photo->user_id, $notification);

        $data['success'] = $status;
        $data['result'] = $result;
        echo json_encode($data);
    }

    public function save_comments_feed(Request $request)
    {
        $comment = $request->comment;
        $status = 0;
        $result = '';
        if ($comment != '') {
            $cmnt = new Comment;
            $cmnt->user_id = \Auth::user()->id;
            $cmnt->photo_id = $request->photo_id;
            $cmnt->comment = $comment;
            $cmnt->save();
            $status = 1;
            $delete_div = '<div class="pull-right"><a href="javascript:void(0)" class="cmnt-del" data-rel="'.$cmnt->id.'">'.trans('messages.utility.delete').'</a></div>';
            $result .= '<div class="mtop20" id="dv-cmnt-'.$cmnt->id.'">
                  <div class="use-img-feed media-photo-badge">
                      <img class="img-responsive" src="'.\Auth::user()->profile_src.'" alt="">
                  </div>
                  <div class="comt">
                     <div class="pull-left wd100">
                        <div class="user-heading"><strong class="pinkColor">'.ucfirst($cmnt->users->name).'</strong>&nbsp;<span class="h5"> '.$cmnt->comment.'</span></div>
                        <div class="chonOption">
                           <ul>
                              <li>'.date('d F Y', strtotime($cmnt->created_at)).$delete_div.'</li>
                           </ul>
                        </div>
                      </div>
                  </div>
                </div><div class="clearfix"></div>';
        }
        $data['success'] = $status;
        $data['result'] = $result;
        echo json_encode($data);
    }

    public function comment_likes(Request $request)
    {
        $comment_id = $request->comment_id;
        $comment = Comment::where('id', $comment_id)->first();
      
        $love = UserLove::where('user_id', AUth::user()->id)->where('photo_id', $photo_id)->first();
        if (isset($love->id)) {
            $love->delete();
            $photo->love_count = $photo->love_count-1;
            $photo->save();
        } else {
            $photo->love_count = $photo->love_count+1;
            $photo->save();
            $userlove = new UserLove;
            $userlove->user_id = Auth::user()->id;
            $userlove->photo_id = $photo_id;
            $userlove->save();
        }
      
        $data['success'] = 1;
        $data['love_count'] = $photo->love_count;

        echo json_encode($data);
    }

    public function delete_comment(Request $request)
    {
        $data['success'] = 0;
        if (\Auth::check()) {
            $comment = Comment::where('id', $request->id)->where('user_id', \Auth::user()->id)->first();
            $comment->delete();
            $data['success'] = 1;
        }

        echo json_encode($data);
    }
}
