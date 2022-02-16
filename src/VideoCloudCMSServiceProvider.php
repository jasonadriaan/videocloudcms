<?php

namespace Jasonadriaan\VideoCloudCMS;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Jasonadriaan\VideoCloudCMS\Commands\VideoCloudCMSCommand;

class VideoCloudCMSServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('videocloudcms')
            ->hasConfigFile();
    }
}
