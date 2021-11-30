<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Address extends Model
{
    protected $hidden = [
        'id',
    ];

    protected $appends = [];

    protected $fillable = ['street_address', 'city', 'postal_code', 'state', 'position', 'address_line_1', 'address_line_2', 'latitude', 'longitude', 'country', 'addressable_id', 'addressable_type'];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->record_id)) {
                $model->record_id = (string) Str::uuid();
            }

            if (empty($model->created_by)) {
                $model->created_by = !auth()->guest() ? auth()->user()->id : 0;
            }
            return true;
        });
    }


    /**
     * Appended attributes
     */

    public function get_address()
    {
        $parts = [];

        if (!empty($this->street_address)) {
            $parts[] = trim($this->street_address, " ");
        }

        if (!empty($this->city)) {
            $parts[] = trim($this->city, " ");
        }

        if (!empty($this->state)) {
            $parts[] = strtoupper(strtolower($this->state));
        }

        if (!empty($this->zipcode)) {
            $parts[] =  trim($this->zipcode, " ");
        }

        return trim(implode(", ", $parts));
    }

    public function getFullAddressAttribute()
    {
        return $this->get_address();
    }

    
    public function addressable()
    {
        return $this->morphTo();
    }

}
