<?php

namespace LiveControls\Address;

use Illuminate\Support\ServiceProvider;

class AddressServiceProvider extends ServiceProvider
{
  public function register()
  {
    $this->mergeConfigFrom(__DIR__.'/../config/config.php', 'live-controls.address.config');
  }

  public function boot()
  {
    if($this->app->runningInConsole()){
      $this->publishes([     
        __DIR__.'/../config/config.php' => config_path('live-controls.address.php'),
      ], 'live-controls.address.config');

      $this->publishesMigrations([
        __DIR__.'/../database/migrations' => database_path('migrations'),
      ], 'live-controls.address.migrations');
    }
  }
}
