<?php

namespace App;

use \Exception;

class Version
{
    /**
     * @var Version|null
     */
    protected static $current_version = null;

    /**
     * @var array
     */
    protected static $version_list = [];

    /**
     * @param Version|null $version
     * @return Version|null
     */
    public static function current(Version $version = null){
        if($version){
            self::$current_version = $version;
            self::$version_list[$version->getVersion()] = $version;
        }
        return self::$current_version;
    }

    /**
     * @var string
     */
    private $namespace = "";

    /**
     * @var string
     */
    private $version = "";

    /**
     * @var string
     */
    private $router = "";

    /**
     * Version constructor.
     * @param integer $version
     */
    public function __construct($version)
    {
        $this->setVersion($version);
        $version = app('config')->get('version.'.$version);
        if(!empty($version)){
            $this->setNamespace($version['namespace']);
            $this->setRouter($version['router']);

            self::current($this);
            app()->router->group([
                'prefix' => "/api/".$this->getVersion(),
                'namespace' => $this->getNamespace('\Controllers')
            ], function($router){
                require $this->getRouter();
            });
        }
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @param string $merge
     * @return string
     */
    public function getNamespace($merge = ""): string
    {
        return $this->namespace.$merge;
    }

    /**
     * @param string $namespace
     */
    public function setNamespace(string $namespace): void
    {
        $this->namespace = $namespace;
    }

    /**
     * @return string
     */
    public function getRouter(): string
    {
        return $this->router;
    }

    /**
     * @param string $route
     */
    public function setRouter(string $router): void
    {
        $this->router = $router;
    }
}