<?php

namespace App\Http\Controllers;

use App\Http\Helpers\Common;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Models\PropertyIcalimport;
use App\Models\PropertyDates;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Mail;
use Config;
use Auth;
use DateTime;
use DateTimeZone;
use App\Models\User;
use App\Models\Rooms;
use App\Models\Bookings;
use File;

class CronController extends Controller
{
    private $helper;

    public function __construct()
    {
        $this->helper = new Common;
    }

    public function index()
    {
      
        $this->sqlDump();
    }

    public function check_booking_expired()
    {
        $date           = new DateTime;
        $date->modify('-24 hours');
        $formatted_date = $date->format('Y-m-d H:i:s');
        $results        = Bookings::where('created_at', '<', $formatted_date)->where('status', 'Pending')->get();
        foreach ($results as $result) {
            Bookings::where('id', $result->id)->update(['status' => 'Expired', 'expired_at' => date('Y-m-d H:i:s')]);
        }
    }

    public function iCalendarSynchronization()
    {  
        $result = PropertyIcalimport::get();
  
        foreach ($result as $row) {
            
            $ical   = new IcalendarController($row->icalendar_url);
            $events = $ical->events();

            // Get events from IcalController
            for ($i=0; $i<$ical->event_count; $i++) {
                $start_date = $ical->iCalDateToUnixTimestamp($events[$i]['DTSTART']);
                $end_date   = $ical->iCalDateToUnixTimestamp($events[$i]['DTEND']);
                $days       = $this->get_days($start_date, $end_date);
                $cnts        = count($days);
              
                // Update or Create a events
                for ($j=0; $j<count($days)-1; $j++) {
                    $calendarDatas = [
                                'property_id' => $row->id,
                                'date'    => $days[$j],
                                'status'  => 'Not available'
                                ];

                    PropertyDates::updateOrCreate(['property_id' => $row->id, 'date' => $days[$j]], $calendarDatas);
                }
            }
            // Update last synchronization DateTime
            $importedIcalendar                      = PropertyIcalimport::find($row->id);
            $importedIcalendar->icalendar_last_sync = date('Y-m-d H:i:s');
            $importedIcalendar->save();
        }
    }

    public function get_days($sStartDate, $sEndDate)
    {
        $sStartDate   = gmdate("Y-m-d", $sStartDate);
        $sEndDate     = gmdate("Y-m-d", $sEndDate);
        
        $aDays[]      = $sStartDate;
        
        $sCurrentDate = $sStartDate;
       
        while ($sCurrentDate < $sEndDate) {
            $sCurrentDate = gmdate("Y-m-d", strtotime("+1 day", strtotime($sCurrentDate)));
            
            $aDays[]      = $sCurrentDate;
        }
      
        return $aDays;
    }

    public function reset_data()
    {
        Artisan::call('db:seed', ['--class' => 'ResetDataSeeder']);
    }

    public function importDump()
    {
        try {
            Log::info("Clearing the junk database");
            Artisan::call('cache:clear');
            Artisan::call('migrate:refresh');
            DB::unprepared(file_get_contents('db/dint_dump.sql'));
            $this->copyImageBackupFiles();
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }

    public function copyImageBackupFiles()
    {
        if (File::isWritable(public_path('front/images/banners')) && File::isWritable(public_path('front/images/logos')) && File::isWritable(public_path('front/images/starting_cities')) && File::isWritable(public_path('images/profile')) && File::isWritable(public_path('images/property')) && File::isWritable(public_path('front/images/testimonial'))) {

              File::cleanDirectory(public_path('front/images/banners'));
              File::cleanDirectory(public_path('front/images/logos'));
              File::cleanDirectory(public_path('front/images/starting_cities'));
              File::cleanDirectory(public_path('images/profile'));
              File::cleanDirectory(public_path('images/property'));
              File::cleanDirectory(public_path('front/images/testimonial'));
              $files_banners      = scandir(public_path('frontend_backup/front/images/banners'));
              $source_images      = public_path('frontend_backup/front/images/banners/');
              $destination_images = public_path('front/images/banners/');

            foreach ($files_banners as $file) {
                if (in_array($file, array(".",".."))) {
                    continue;
                }
                copy($source_images.$file, $destination_images.$file);
            }

                $files_logos       = scandir(public_path('frontend_backup/front/images/logos'));
                $source_logos      = public_path('frontend_backup/front/images/logos/');
                $destination_logos = public_path('front/images/logos/');

            foreach ($files_logos as $file) {
                if (in_array($file, array(".",".."))) {
                    continue;
                }
                copy($source_logos.$file, $destination_logos.$file);
            }
              $files_starting_cities       = scandir(public_path('frontend_backup/front/images/starting_cities'));
              $source_starting_cities      = public_path('frontend_backup/front/images/starting_cities/');
              $destination_starting_cities = public_path('front/images/starting_cities/');

            foreach ($files_starting_cities as $file) {
                if (in_array($file, array(".",".."))) {
                    continue;
                }
                copy($source_starting_cities.$file, $destination_starting_cities.$file);
            }

             $files_testimonial       = scandir(public_path('frontend_backup/front/images/testimonial'));
              $source_testimonial      = public_path('frontend_backup/front/images/testimonial/');
              $destination_testimonial = public_path('front/images/testimonial/');

            foreach ($files_testimonial as $file) {
                if (in_array($file, array(".",".."))) {
                    continue;
                }
                copy($source_testimonial.$file, $destination_testimonial.$file);
            }

            for ($property=1; $property<=16; $property++) {
                          $path = public_path('images/property/').$property;
                          mkdir($path, 0777, true);
                          $files_property       = scandir(public_path("frontend_backup/images/property/$property"));
                          $source_property      = public_path("frontend_backup/images/property/$property/");
                          $destination_property = public_path("images/property/$property/");
                foreach ($files_property as $file) {
                    if (in_array($file, array(".",".."))) {
                        continue;
                    }
                    copy($source_property.$file, $destination_property.$file);
                }
            }
            for ($profile=1; $profile<=4; $profile++) {
                      $path = public_path('images/profile/').$profile;
                      mkdir($path, 0777, true);
                      $files_profile       = scandir(public_path("frontend_backup/images/profile/$profile"));
                      $source_profile      = public_path("frontend_backup/images/profile/$profile/");
                      $destination_profile = public_path("images/profile/$profile/");
                foreach ($files_profile as $file) {
                    if (in_array($file, array(".",".."))) {
                        continue;
                    }
                          copy($source_profile.$file, $destination_profile.$file);
                }
            }

        } else {
            Log::info("Don't have write permission !");
        }
    }
}
