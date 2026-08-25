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
        __DIR__.'/../config/config.php' => config_path('live-controls.address.config.php'),
      ], 'live-controls.address.config');   

      // Export the migration    
      if(!class_exists('CreateFlowRunsTable')){     
        $this->publishes([
          __DIR__.'/../database/migrations/create_address_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()).'_create_flow_runs_table.php'),              
        ], 'live-controls.address.migrations');     
      }    
    }
  }
}
