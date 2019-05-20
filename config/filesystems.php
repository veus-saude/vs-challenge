<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Default Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default filesystem disk that should be used
    | by the framework. The "local" disk, as well as a variety of cloud
    | based disks are available to your application. Just store away!
    |
    */

    'default' => env('FILESYSTEM_DRIVER', 'local'),

    /*
    |--------------------------------------------------------------------------
    | Default Cloud Filesystem Disk
    |--------------------------------------------------------------------------
    |
    | Many applications store files both locally and in the cloud. For this
    | reason, you may specify a default "cloud" driver here. This driver
    | will be bound as the Cloud disk implementation in the container.
    |
    */

    'cloud' => env('FILESYSTEM_CLOUD', 's3'),

    /*
    |--------------------------------------------------------------------------
    | Filesystem Disks
    |--------------------------------------------------------------------------
    |
    | Here you may configure as many filesystem "disks" as you wish, and you
    | may even configure multiple disks of the same driver. Defaults have
    | been setup for each driver as an example of the required options.
    |
    | Supported Drivers: "local", "ftp", "s3", "rackspace"
    |
    */

    'disks' => [

        'local' => [
            'driver' => 'local',
            'root' => storage_path('app'),
        ],

        'public' => [
            'driver' => 'local',
            'root' => storage_path('app/public'),
            'url' => env('APP_URL').'/storage',
            'visibility' => 'public',
        ],

        'ftp' => [
            'driver' => 'ftp',
            'host' => '104.236.66.144',
            'port' => '21',
            'username' => 'root',
            'password' => 'SrvCorretor@802On2017',
            'root' => '/var/www/html/corretor-on/',
//            'passive' => true,
//            'ssl' => true,
//            'timeout' => 20,
//            'visibility' => 'public',
//            'pirate' => false,
//            'eventable' => true,
//            'cache' => 'foo'
        ],

        'sftp' => [
            'driver' => 'sftp',
            'host' => env('SFTP_HOST'),
//            'port' => 22,
            'username' => env('SFTP_USERNAME'),
            'password' => env('SFTP_PASSWORD'),
            'root' => env('SFTP_ROOT','/')
            // 'privateKey' => 'path/to/or/contents/of/privatekey',
            // 'timeout'    => 20,
            // 'visibility' => 'public',
            // 'pirate'     => false,
            // 'eventable'  => true,
            // 'cache'      => 'foo'
        ],

        's3' => [
            'driver' => 's3',
            'key' => env('AWS_KEY'),
            'secret' => env('AWS_SECRET'),
            'region' => env('AWS_REGION'),
            'bucket' => env('AWS_BUCKET'),
        ],

    ],

];
