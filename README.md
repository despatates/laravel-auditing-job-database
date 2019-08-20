# laravel-auditing-job-database

A database driver for the owen-it/laravel-auditing package. Store audits using laravel jobs.

## Installation

Ensure you are using `owen-it/laravel-auditing: ^8.0`.

This package is not published on [Packagist](https://packagist.org/), so add its url in the repositories list of your app in `composer.json`.
```
"repositories": [
    {
        "type": "vcs",
        "url": "https://github.com/despatates/laravel-auditing-job-database"
    }
]
```

Then install the driver:
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
