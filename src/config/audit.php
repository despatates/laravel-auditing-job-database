<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Queue Auditable Models
    |--------------------------------------------------------------------------
    |
    | This option allows you to control if the operations that audit your models
    | with your auditors are queued. When this is set to "true" then all models
    | auditable will get queued for better performance.
    |
    */
    'queue' => env('AUDIT_QUEUE', true),

    /*
    |--------------------------------------------------------------------------
    | Audit Driver
    |--------------------------------------------------------------------------
    |
    | The default audit driver used to keep track of changes.
    |
    */

    'driver' => Levell\Auditing\Drivers\JobDatabase::class,
];
