<?php   

namespace App\Repositories;   

use App\Repositories\BaseRepository; 
use Illuminate\Database\Eloquent\Model;   
use App\Models\PointsLog;
use App\Models\User;

class PointsRepository extends BaseRepository
{     
    /**      
     * @var Model      
     */     
     protected $model;       

    /**      
     * BaseRepository constructor.      
     *      
     * @param Model $model      
     */     
    public function __construct(PointsLog $model)     
    {         
        $this->model = $model;
    }
 
    /**
    * @param array $attributes
    *
    * @return Model
    */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }
 
    /**
    * @param $id
    * @return Model
    */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    public function addPointsToUserFromPayment(User $user, $amount, $meta = []){
        $points = $this->getPointsFromCash($amount);
        return $this->addPointsToUser($user, $points, $meta);
    }

    private function getPointsFromCash($amount){
        return ceil($amount)*10;
    }

    public function updateUsersPoints(User $user){
        $user->total_available_mature_points = $this->getAccumulatedMaturedPointsBalanceForUser($user);
        $user->total_available_points = $this->getAccumulatedPointsBalanceForUser($user);
        $user->save();
    
    }

    public function addPointsToUser(User $user, $points, $meta = []){
        $data = array();
        $data['user_id'] = $user->id;
        $data['points'] = $points;
        $data['mode'] = PointsLog::FLAG_ADDED;
        if(isset($meta['pointable_type'])){
            $data['pointable_type'] = $meta['pointable_type'];
            $data['pointable_id'] = $meta['pointable_id'];
        }
        $data['notes'] = isset($meta['notes'])?$meta['notes']:'';

        $this->create($data);

        $this->updateUsersPoints($user);
    }

    public function canUserRedeemPoints(User $user, $points){
        $points_available = $this->getAccumulatedPointsBalanceForUser($user);
        if($points_available < $points){
            return false;
        }

        return true;
    }

    public function redeemPointsToUser(User $user, $points, $meta = []){

        if(!$this->canUserRedeemPoints($user, $points)){
            return false;
        }

        $data = array();
        $data['user_id'] = $user->id;
        $data['points'] = $points;
        $data['mode'] = PointsLog::FLAG_REDEEMED;
        if(isset($meta['pointable_type'])){
            $data['pointable_type'] = $meta['pointable_type'];
            $data['pointable_id'] = $meta['pointable_id'];
        }
        $data['notes'] = isset($meta['notes'])?$meta['notes']:'';

        $this->create($data);

        $this->updateUsersPoints($user);
        return true;
    }

    public function getAllPointsLogsForUser(User $user, $params = []){

        $q = $this->model->select()->byUser($user->id);

        return $q->get()->all();
    }

    public function getAccumulatedMaturedPointsBalanceForUser(User $user){
        $points_added_only = $this->getAddedMaturedPointsForUser($user);
        $points_redeemed_only = $this->getRedeemedPointsForUser($user);
        return $points_added_only - $points_redeemed_only;
    }

    public function getAccumulatedPointsBalanceForUser(User $user){
        $points_added_only = $this->getAddedPointsForUser($user);
        $points_redeemed_only = $this->getRedeemedPointsForUser($user);
        return $points_added_only - $points_redeemed_only;
    }

    public function getAddedPointsForUser(User $user){
        $points_added_only = $this->model->select()->byUser($user->id)->addsOnly()->sum('points');
        return $points_added_only;
    }
    public function getAddedMaturedPointsForUser(User $user){
        $points_added_only = $this->model->select()->byUser($user->id)->addsOnly()->maturedOnly()->sum('points');
        return $points_added_only;
    }

    public function getRedeemedPointsForUser(User $user){
        $points_redeemed_only = $this->model->select()->byUser($user->id)->redeemedOnly()->sum('points');
        return $points_redeemed_only;
    }

}
