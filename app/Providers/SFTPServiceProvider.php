<?php
namespace App\Providers;

use League\Flysystem\Sftp\SftpAdapter;
use Storage;
use League\Flysystem\Filesystem;
use Illuminate\Support\ServiceProvider;

class SFTPServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Storage::extend('sftp', function ($app, $config) {
            $filesystem = new Filesystem(new SftpAdapter($config));
            return $filesystem;
        });
    }
}