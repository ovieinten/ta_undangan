<?php
namespace COOEM\Core\Providers;


use Illuminate\Support\ServiceProvider;

class CoreServiceProvider extends ServiceProvider
{
    public function register()
    {
        $helpers = glob(__DIR__.'/../Helpers/*.php', GLOB_BRACE);
        foreach($helpers as $helper) {
            require_once($helper);
        }

        $this->mergeConfigFrom(__DIR__.'/../Config/config.php', 'core');
    }

    public function boot()
    {
        $this->publishes([
            __DIR__ . '../Config' => config_path('core')
        ]);
    }
}