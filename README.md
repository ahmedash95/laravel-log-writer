# Laravel Custom Log Writer
customize your laravel log into seperated files

## Installation

You can install the package via composer:

``` bash
composer require ahmedash95/logwriter
```

Next up, the service provider must be registered:

```php
// config/app.php
'providers' => [
    ...
    Ahmedash95\LogWriter\Providers\LogWriterServiceProvider::class,

];

// Register alias
'aliases' => [
    ...
    'LogWriter' => Ahmedash95\LogWriter\Facades\LogWriterFacade::class,
    
];
```

you must publish the config file for customize log files:
```
php artisan vendor:publish --provider="Ahmedash95\LogWriter\Providers\LogWriterServiceProvider"
```

This is the contents of the published file: ```config/logwriter.php```

```php
<?php

use Monolog\Logger;

return [

    /*
     * The base path of log files
     */
    'log_path' => storage_path(),

    /*
     * The Log channels.
     */
    'channels' => [
        'event' => [
            'path'  => 'logs/event.log',
            'level' => Logger::INFO,
        ],
        'audit' => [
            'path'  => 'logs/audit.log',
            'level' => Logger::INFO,
        ],
    ],

    /*
     * The Log levels.
     */
    'levels' => [
        'debug'     => Logger::DEBUG,
        'info'      => Logger::INFO,
        'notice'    => Logger::NOTICE,
        'warning'   => Logger::WARNING,
        'error'     => Logger::ERROR,
        'critical'  => Logger::CRITICAL,
        'alert'     => Logger::ALERT,
        'emergency' => Logger::EMERGENCY,
    ],

];
```


### Available methods

#### Log to file
The easiest way to log info in the file is to use write method

```php
LogWriter::write('event','This is log line into event file');
```

#### log levels
Also you can use defferent types that definted in levels list 
```php
LogWriter::alert('event','Using log levels');
// or
LogWriter::warning('event','Using log levels');
```

## Credits

- [Ahmed Ashraf](https://github.com/ahmedash95)
- [All Contributors](../../contributors) not yet :)

## License
The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
