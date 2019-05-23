<?php

if(!function_exists('version')){
    /**
     * @param string $version
     * @return \App\Version|null|string
     * @throws Exception
     */
    function version($version = null){
        return $version ? new \App\Version($version) : \App\Version::current();
    }
}

if(!function_exists('config_path')){
    /**
     * Get the path to the config.
     *
     * @param  string  $path
     * @return string
     */
    function config_path($path = '')
    {
        return app()->basePath()."/config".($path ? '/'.$path : $path);
    }
}