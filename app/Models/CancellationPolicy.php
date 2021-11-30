<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CancellationPolicy extends Model
{
    protected $table    = 'cancellation_policies';
    
    public function property()
    {
        return $this->belongsTo('App\Models\properties', 'property_id', 'id');
    }
}
