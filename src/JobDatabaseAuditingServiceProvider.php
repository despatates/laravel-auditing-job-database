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
        $this->publishes([
            __DIR__ . '/config/audit.php' => config_path('audit.php'),
        ], 'config');
    }
}
