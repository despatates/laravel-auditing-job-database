<?php

namespace Levell\Auditing;

use Illuminate\Support\ServiceProvider;

class JobDatabaseAuditingServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/config/audit.php' => $this->app['path.config'] . DIRECTORY_SEPARATOR . 'audit.php',
            ]);
        }
    }
}
