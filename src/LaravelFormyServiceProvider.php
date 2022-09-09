<?php

namespace Visanduma\LaravelFormy;

use Closure;
use Illuminate\Support\Facades\Blade;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use Visanduma\LaravelFormy\Commands\LaravelFormyCommand;

class LaravelFormyServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-formy')
            ->hasConfigFile()
            ->hasViews('formy')
            ->hasRoute('web')
            ->hasMigration('create_formy_table')
            ->runsMigrations()
            ->hasCommand(LaravelFormyCommand::class);

        $this->publishes([
            __DIR__.'/../resources/views/themes' => resource_path('views/vendor/formy/themes')
        ], 'formy-themes');

        $this->publishes([
            __DIR__.'/../public/formy' => public_path('vendor/formy/')
        ], 'formy-assets');


    }


    public function bootingPackage()
    {
        Blade::directive('formy',function($form){
            return "<?php echo " .$form."->render() ?>";
        });


    }

}
