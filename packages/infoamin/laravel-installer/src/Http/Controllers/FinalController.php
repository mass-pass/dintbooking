<?php

namespace Infoamin\Installer\Http\Controllers;

use AppController;
use Artisan;

class FinalController extends AppController
{
    /**
     * Complete the installation
     *
     * @return \Illuminate\View\View
     */
    public function finish()
    {
        // Remove service provider
        $path = base_path('config/app.php');

        file_put_contents($path, str_replace('Infoamin\Installer\LaravelInstallerServiceProvider::class,', '', file_get_contents($path)));

        // Debugging mode disabled
        changeEnvironmentVariable('APP_DEBUG', false);


        // Change key in .env
        Artisan::call('key:generate');
        Artisan::call('config:clear');
        Artisan::call('cache:clear');
        Artisan::call('view:clear');

        return view('vendor.installer.finish');
    }
}
