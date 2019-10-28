<?php

namespace App\Config;

class Configuration
{
    // App configs
    const APP_VERSION = '0.0.1';
    // WARNING: CHANGE THIS CONTENT
    const SALT_KEY = 'G14AXD74JWSAAGUAJG1WPW4I0JM2EF4L7YLT2JOB67C6EX6N4Y9JJ4SAE62IBWT8';
    const BASE_DIR = __DIR__;
    const DS = DIRECTORY_SEPARATOR;
    const USER_ENTITY = "users";
    const JSON_SCHEMA = self::DS . 'app' . self::DS . 'Json_schemes';
    /**
     * 8 hours in seconds
     */
    const EXPIRATE_TOKEN = 28800;
    const HOST_DEV = 'localhost';
}