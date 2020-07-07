# laravel-auditing-job-database

A database driver for the owen-it/laravel-auditing package. Store audits using laravel jobs.

## Installation

Ensure you are using `owen-it/laravel-auditing: ^8.0`.

Install the driver with:

```
composer require despatates/laravel-auditing-job-database
```

## Setup

You need to add the following config entries in `config/audit.php` if you need to change the default behaviour of the driver.
The `queue` key of the config file should look like so:

```
    ...
    'queue' => env('AUDIT_QUEUE', true),
    ...
```

OR

```
    ...
    'queue' => env('AUDIT_QUEUE', [
        'queue' => 'default',
        'connection' => null,
    ]),
    ...
```

The `driver` key of the config file should look like so:

```
    ...
    'driver' => Levell\Auditing\Drivers\JobDatabase::class,
    ...
```
