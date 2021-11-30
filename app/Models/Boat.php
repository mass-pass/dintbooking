<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Address;
class Boat extends Model
{
    protected $table = 'boats';
    protected $guarded = ['id'];
    const TYPES = array(    'motorboat'=>'Motorboat',
                            'sailboat'=>'Sailboat',
                            'rib'=>'RIB',
                            'catamaran'=>'Catamaran',
                            'houseboat'=>'Houseboat',
                            'jet-ski'=> 'Jet ski',
                            'yacht'=>'Yacht');
    protected $casts =[
        'languages' => 'array',
        'photos' => 'array',
        'amenities' => 'array'
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'owner_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany('App\Models\Reviews', 'property_id', 'id');
    }
    
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable');
    }

}
