<?php



namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PropertyUnit extends Model
{
    protected $table   = 'property_units';

    public function property_layout()
    {
        return $this->belongsTo('App\Models\PropertyLayout', 'property_layout_id', 'id');
    }

    public function generatePropertyUnitNumber($propertyLayoutId)
    {
        $existingNumbers = $this->where('property_layout_id', $propertyLayoutId)
                            ->where('property_layout_id', '!=', '')
                            ->select('property_unit_number')
                            ->get();
        $existingNumbers = $existingNumbers->pluck('property_unit_number');
        $number = rand(100, 999);
        while($existingNumbers->contains($number)) {
            $number = rand(100, 999);
        }

        return $number;
    }

}
