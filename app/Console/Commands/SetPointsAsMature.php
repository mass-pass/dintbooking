<?php

namespace App\Console\Commands;

use App\Models\PointsLog;
use Illuminate\Console\Command;

class SetPointsAsMature extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'points:mature';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $this->info('Marking points as matured that have passed');
        $points = PointsLog::immaturedOnly()->get();
        foreach($points as $pk => $pv){
            $booking = \App\Models\Bookings::find($pv->pointable_id);
            $end_date = \Carbon\Carbon::parse($booking->end_date);
            $this->info('End Date '.$end_date);
            $this->info('End Date '.$booking->end_date);
            $this->info($end_date->isPast());
            if($end_date->isPast()){
                $pv->is_matured = 1;
                $pv->updated_at = now();
                $pv->save();
            }
        }
        $this->info('All Done :)');
        return true;

    }
}
