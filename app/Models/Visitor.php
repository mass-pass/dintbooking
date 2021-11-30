<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $table = 'visitors';
    protected $guarded = ['id'];
    protected $dates = ['created_at','updated_at'];

    /**==========
     * Relations
     ===========*/
    /**
     * return related visitor_searches
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function visitorSearches(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(VisitorSearch::class);
    }
}
