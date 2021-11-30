<?php

namespace App\Console\Commands;

use App\Models\Properties;
use App\Models\Boat;
use Illuminate\Console\Command;
use Illuminate\Support\Str;
class PopulateSlug extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:slug';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command will populate slug column on properties table, slug will be created on the basis of title';

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
        $this->info('Updating slug');
        $properties = Properties::withTrashed()->get();
        foreach($properties as $pk => $pv){
            $pv->slug = Str::slug($pv->name, '-')."-".$pv->id;
            $pv->updated_at = now();
            $pv->save();
        }
        $boats = Boat::get();
        foreach($boats as $bk => $bv){
            $bv->slug = Str::slug($bv->title, '-')."-".$bv->id;
            $bv->updated_at = now();
            $bv->save();
        }
        $this->info('Done...');
        return true;
    }
}
