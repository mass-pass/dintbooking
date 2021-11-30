<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $table    = 'discounts';
    const TYPE_STANDARD = 'standard';
    const TYPE_LENGTH_OF_STAY = 'length-of-stay';
    const TYPE_CUSTOM = 'custom';

    const APPLICABLE_FIRST_TIME = 'first-time';
    const APPLICABLE_EARLY_BIRD = 'early-bird';
    const APPLICABLE_LAST_MINUTE = 'last-minute';
    const APPLICABLE_LENGTH_OF_STAY = 'length-of-stay';
    const APPLICABLE_CUSTOM = 'custom';

    const ATTRIBUTES = [ 'discountable_type', 'discountable_id', 'title', 'description', 'type', 'percentage', 'applicable_at', 'applicable_meta' ];

    public function discountable(){
        return $this->morphTo();
    }
    protected $casts = [
        'applicable_meta' => 'array',
    ];

}
