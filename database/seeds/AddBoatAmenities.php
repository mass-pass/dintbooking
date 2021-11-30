<?php

use Illuminate\Database\Seeder;

class AddBoatAmenities extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $amenities = array(
        'Outdoor equipment' => ['Bimini', 'Deck shower', 'Cockpit table', 'Cockpit speakers', 'Teak deck', 'Bow sundeck', 'Stern sundeck', 'Aft Bathing Platform',
            'Bathing ladder'], 
        'Extra Comfort'=>['Hot water', 'Desalinator', 'Air conditioning', 'Fans', 'Heating', 'Electric toilet',
            'Bath towels', 'Beach Towels', 'Wi-Fi', 'USB socket', 'TV'],
        'Navigation equipment'=>["Dinghy", "Dinghy's engine", "Bow thruster", "Electric windlass", "Automatic pilot", "GPS",
            "Depth sounder", "VHF", "Satellite phone", "Guides & Maps"],
        'Kitchen'=>["Fridge", "Freezer", "Oven/stovetop", "Barbecue grill", "Microwave", "Coffee machine", "Ice machine", "Cooler"],
        'Leisure activities'=>[
            'Paddle board', 'Kayak', 'Mask and snortil', 'Fishing tackle', 'Diving equipment', 'Seabob', 'Bike', 'Electric scooter', 'Drone', 'Camera'
        ],
        
        'Onboard energy'=>[
            'Generator',
            'Inverter',
            '220V power outlet'
        ],

        'Water sports'=>['Water skis',
            'Monoski',
            'Wakeboard',
            'Towable Tube',
            'Inflatable banana',
            'Kneeboard'
        ]);
        foreach($amenities as $ii=>$amenity_list){
            $amenity_type_id = DB::table('amenity_type')->insertGetId(
                ['name' => $ii,'description' => '']);
                foreach($amenity_list as $vv){
                    DB::table('amenities')->insert(
                        ['type_id' => $amenity_type_id, 'title' => $vv,'description' => '', 'category'=>'Boat','symbol' => str_slug($vv)],
                    );
                }
        
        }


    }
}
