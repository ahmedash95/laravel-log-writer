<?php

namespace Ahmedash95\LogWriter\Providers;

use Ahmedash95\LogWriter\LogWriter;
use Illuminate\Support\ServiceProvider;

class LogWriterServiceProvider extends ServiceProvider {
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../../Config/logwriter.php', 'logwriter');

        $this->app->singleton('logwriter', function ($app) {
            $config = $this->app['config']['logwriter'];
            return new LogWriter($config);
        });
    }
}
