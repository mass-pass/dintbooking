<?php

namespace App\Http\Controllers\Partner;

use Illuminate\Http\Request;
use Auth;

use App\Http\{
    Helpers\Common,
    Controllers\Controller
};

use App\Models\Properties;

class PropertyController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function listings(Properties $property = null)
    {
        $data = [];
        if ($property) {
            $data["current_property_id"] = $property->id;
        } else {
            $data["current_property_id"] = null;
        }
        $data['title'] = 'Property listings';
        $data['properties'] = Properties::where('host_id', \Auth::id())->orderBy('id', 'desc')->paginate(\Session::get('row_per_page'));

        return view('partner.property.listings', $data);
    }

    public function layout(Properties $property = null)
    {
        $data['title'] = 'Property Layout';
        $data['property'] = Properties::where('host_id', \Auth::id());
        if ($property) {
            $data["current_property_id"] = $property->id;
            $data['property']->where('id', $property->id);
        } else {
            $data["current_property_id"] = null;
        }
        $data['property'] = $data['property']->orderBy('id', 'desc')->first();

        return view('partner.property.layout', $data);
    }

    public function editLayout(Request $request, Properties $property, $id){
        $data = [];
        $data['title'] = 'Property Layout';
        // grab the id of the first property
        $data['current_property_id'] = $property->id;
        $data['property_layout'] = \App\Models\PropertyLayout::find($id);
        $data['property'] = $data['property_layout']->property;
        $data['property_types'] = \App\Models\PropertyType::where('status', 'Active')->pluck('name', 'id');
        $data['space_types'] =  \App\Models\SpaceType::where('status', 'Active')->pluck('name', 'id');

        $data['room_name_suggestions'] = ["Budget single room", "Deluxe single room", "Deluxe single room with balcony", "Delux single room with sea view", "Economy single room", "Large single room", "New year's eve special - single room", "single room", "single room - Disability access", "single room with balcony", "single room with bath", "single room with bathroom", "single room with lake view", "single room with mountain view", "single room with park view", "single room with pool view", "single room with private bathroom", "single room with private external bathroom", "single room with sea view", "single room with shared bathroom", "single room with shared shower and toilet", "single room with shared toilet", "single room with shower", "single room with terrace", "Small single room", "Standard single room", "Standard single room with mountain view", "Standard single room with sauna"];
        $data['bed_types'] = ["Single bed / 90-130 wide","Double bed / 131-150 cm wide","Large bed (King size) / 151-180 cm wide","Extra-Large double bed (Super-king size) / 181-210 cm wide","Bunk bed / Variable Size","Sofa bed / Variable Size","Futon bed / Variable Size"];

        if($request->isMethod('post')){
            $property_layout = $data['property_layout'];

            $old_units_count = count($property_layout->property_units);
            $property_layout->title = $request->title;
            $property_layout->title_custom = $request->title_custom;
            $property_layout->description = $request->description?$request->description:'';
            $property_layout->property_type_id = $request->property_type_id;
            $property_layout->max_occupancy = $request->max_occupancy;
            $property_layout->max_occupancy_adults = $request->max_occupancy_adults;
            $property_layout->max_occupancy_children = $request->max_occupancy_children;
            $property_layout->beds = ($request->beds);
            $property_layout->bathrooms = ($request->bathrooms);
            $property_layout->pricing = ([]);
            $property_layout->number_of_units = $request->number_of_units;
            $property_layout->number_of_bathrooms = $request->number_of_bathrooms;
            $property_layout->floor_level = $request->floor_level;
            $property_layout->no_of_floors = $request->no_of_floors;
            $property_layout->save();

            if ($old_units_count < $request->number_of_units) {
                for ($i = 0; $i < ($request->number_of_units - $old_units_count); $i++) {
                    $property_unit = new \App\Models\PropertyUnit();
                    $property_unit->property_layout_id = $property_layout->id;
                    $property_unit->title = $property_layout->title;
                    $property_unit->property_unit_number = $property_unit->generatePropertyUnitNumber($id);
                    $property_unit->description = $property_layout->description ? $property_layout->description : '';
                    $property_unit->save();    
                }
            }

            return redirect()->route('layout', ['property' => $property->id]);
        }


        return view('partner.property.edit_property_layout', $data);

    }

    public function createNewProperty(Request $request)
    {
        $data = [];
        $data['title'] = 'Property Layout';
        $data['current_property_id'] = getCurrentPropertyIdInSession();
        if (!$data['current_property_id']) {
            return selectPropertyFirst();
        }
        // grab the id of the first property
        $data['property'] = Properties::where('host_id', \Auth::id())->orderBy('id', 'desc')->first();
        $data['property_types'] = \App\Models\PropertyType::where('status', 'Active')->pluck('name', 'id');
        $data['space_types'] =  \App\Models\SpaceType::where('status', 'Active')->pluck('name', 'id');

        $data['room_name_suggestions'] = ["Budget single room", "Deluxe single room", "Deluxe single room with balcony", "Delux single room with sea view", "Economy single room", "Large single room", "New year's eve special - single room", "single room", "single room - Disability access", "single room with balcony", "single room with bath", "single room with bathroom", "single room with lake view", "single room with mountain view", "single room with park view", "single room with pool view", "single room with private bathroom", "single room with private external bathroom", "single room with sea view", "single room with shared bathroom", "single room with shared shower and toilet", "single room with shared toilet", "single room with shower", "single room with terrace", "Small single room", "Standard single room", "Standard single room with mountain view", "Standard single room with sauna"];


        $data['bed_types'] = ["Single bed / 90-130 wide","Double bed / 131-150 cm wide","Large bed (King size) / 151-180 cm wide","Extra-Large double bed (Super-king size) / 181-210 cm wide","Bunk bed / Variable Size","Sofa bed / Variable Size","Futon bed / Variable Size"];


        if($request->isMethod('post')){
            $property_layout = new \App\Models\PropertyLayout();
            $property_layout->title = $request->title;
            $property_layout->title_custom = $request->title_custom;
            $property_layout->description = $request->description?$request->description:'';
            $property_layout->property_type_id = $request->property_type_id;

            $property_layout->max_occupancy = $request->max_occupancy;
            $property_layout->max_occupancy_adults = $request->max_occupancy_adults;
            $property_layout->max_occupancy_children = $request->max_occupancy_children;
            $property_layout->beds = ($request->beds);
            $property_layout->bathrooms = ($request->bathrooms);
            $property_layout->pricing = ([]);
            $property_layout->number_of_units = $request->number_of_units;
            $property_layout->number_of_bathrooms = $request->number_of_bathrooms;
            $property_layout->floor_level = $request->floor_level;
            $property_layout->no_of_floors = $request->no_of_floors;
            $property_layout->property_id = $data['property']->id;;
            $property_layout->save();

            for($i=0;$i<$request->number_of_units;$i++){
                $property_unit = new \App\Models\PropertyUnit();
                $property_unit->property_layout_id = $property_layout->id;
                $property_unit->title = $property_layout->title;
                $property_unit->property_unit_number = $property_unit->generatePropertyUnitNumber($property_layout->id);
                $property_unit->description = $property_layout->description?$property_layout->description:'';
                $property_unit->save();    
            }
            return redirect()->route('layout', ['property' => $data['current_property_id'] ]);

        }


        return view('partner.property.create_new_property', $data);
    }

    public function createNewPropertyWithDiffAddres(Request $request)
    {
        $data['title'] = 'Property Layout';
        return view('partner.property.create_new_property_with_diff_address', $data);
    }
}
