<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class SyncPropertyAddresses extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:propertyAddresses';

    private $propertyNameSpace = 'App\Models\Properties';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to migrate all property address from old property_address table to addresses.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        try {
            $oldAddresses = \App\Models\PropertyAddress::all();
        } catch (\Exception $e) {
            $this->error($e->getMessage());
            
            return false;
        }

        $oldAddresses->each(function($oldAddress) {
            $exist = \App\Models\Address::where([
                'addressable_id' => $oldAddress->property_id,
                'addressable_type' => $this->propertyNameSpace
            ])->first();
            if ($exist || !$oldAddress->property_id || $oldAddress->property_id == '') {
                return true;
            }
            $this->info('Processing old property_address id: '. $oldAddress->id .'. For property id: '. $oldAddress->property_id);
            try {
                \App\Models\Address::create([
                    'address_line_1' => ($oldAddress->address_line_1) ?? '',
                    'address_line_2' => ($oldAddress->address_line_2) ?? '',
                    'latitude' => ($oldAddress->latitude) ?? '',
                    'longitude' => ($oldAddress->longitude) ?? '',
                    'city' => ($oldAddress->city) ?? '',
                    'state' => ($oldAddress->state)  ?? '',
                    'country' => ($oldAddress->country)  ?? '',
                    'postal_code' => ($oldAddress->postal_code)  ?? '',
                    'addressable_id' => $oldAddress->property_id,
                    'addressable_type' => $this->propertyNameSpace
                ]);
                $this->info('Successfully processed old property_address id: '. $oldAddress->id .'. For property id: '. $oldAddress->property_id . PHP_EOL);
            } catch(\Exception $e) {
                $this->info('Error while processing old property_address id: '. $oldAddress->id .'. For property id: '. $oldAddress->property_id);
            }
        });
    }
}
