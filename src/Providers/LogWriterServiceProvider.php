<?php

namespace Ahmedash95\LogWriter\Providers;

use Ahmedash95\LogWriter\LogWriter;
use Illuminate\Support\ServiceProvider;

class LogWriterServiceProvider extends ServiceProvider {

    /**
     * Publish config file.
     *
     * @return void
     */
    public function boot(){
        $this->publishes([
            __DIR__.'/../../config/logwriter.php' => config_path('logwriter.php'),
        ]);
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../config/logwriter.php', 'logwriter');


        $this->app->singleton('logwriter', function ($app) {
            $config = $this->app['config']['logwriter'];

            return new LogWriter($config);
        });
    }
}
