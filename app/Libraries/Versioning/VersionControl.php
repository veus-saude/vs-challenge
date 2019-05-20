<?php
/**
 * version control class for handling request
 * and alter current namespace with versionized
 * namespace from Accept Header
 *
 * @author Mike Alvarez <mike@hallohallo.ph>
 */

namespace App\Libraries\Versioning;

use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\App;

class VersionControl implements VersionControlInterface
{
    /**
     * fallback api version
     *
     * @var integer
     */
    protected $fallbackVersion = 1;

    /**
     * api version control accept header value pattern
     *
     * @var string
     */
    protected $acceptHeaderPattern = 'application\/vnd\.api\-v([\d]+(?:\.[\d]+)*(?:a|b)?)\+json';

    /**
     * namespace version placeholder
     *
     * @var string
     */
    protected $namespaceVersionPlaceholder = '{d}';

    /**
     * class constructor
     *
     * @param \Illuminate\Http\Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

        /**
     * get current fallback version
     *
     * @return integer
     */
    public function getFallbackVersion()
    {
        return (int) $this->fallbackVersion;
    }

    /**
     * set fallback version
     *
     * @throws \InvalidArgumentException
     *
     * @param integer $version
     */
    public function setFallbackVersion($version = null)
    {
        if (! $version) {
            return;
        }

        if (! filter_var($version, FILTER_VALIDATE_INT)) {
            throw new \InvalidArgumentException(
                sprintf('version must be a valid integer, %s given', gettype($version)),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }

        $this->fallbackVersion = (int) $version;
    }

    /**
     * get accept header pattern
     *
     * @return string
     */
    public function getAcceptHeaderPattern()
    {
        return (string) $this->acceptHeaderPattern;
    }

    /**
     * set accept header pattern
     *
     * @throws \InvalidArgumentException
     *
     * @param string $pattern
     */
    public function setAcceptHeaderPattern($pattern = null)
    {
        if (! $pattern) {
            return;
        }

        if (! is_string($pattern)) {
            throw new \InvalidArgumentException(
                sprintf('pattern must be a valid string, %s given', gettype($pattern))
            );
        }

        $this->acceptHeaderPattern = (string) $pattern;
    }

    /**
     * process request version control
     *
     * @return void
     */
    public function processRequestVersioning(Request $request = null)
    {
        if (! is_null($request)) {
            $this->request = $request;
        }

        $version = $this->getVersionFromAcceptHeader();

        // set to input version
        $this->setRequestVersion($version);

        // normalize version normal number
        $version = floor((int) $version);

        if (! $version) {
            $version = $this->getFallbackVersion();
        }

        $routeInfo = $this->getRouteInfoFromRequest();

        if (! array_key_exists('uses', $routeInfo)) {
            return;
        }

        $uses      = $routeInfo['uses'];
        $namespace = $this->extractNamespace($uses);

        if (! $namespace) {
            return;
        }

        $versionNamespace = $this->createVersionNamespace($version, $namespace);
        $versionUses      = $this->replaceNamespaceWithVersionNamespace($namespace, $versionNamespace, $uses);

        // throws 400 (Bad Request)
        if (! $this->isControllerCallable($versionUses)) {
            return $this->createResponse(
                ['message' => trans('version.invalid_version')],
                Response::HTTP_BAD_REQUEST
            )->throwResponse();
        }

        $this->overrideRouteResolverWithVersion($versionUses);
    }

    /**
     * get route array from request
     *
     * @return array
     */
    protected function getRouteInfoFromRequest()
    {
        $route = $this->request->route();

        if (! is_array($route)) {
            $route = [];
        }

        return (count($route) >= 2) ? $route[1] : [];
    }

    /**
     * overrides current route resolver callback
     *
     * @param  string $uses
     *
     * @return void
     */
    public function overrideRouteResolverWithVersion($uses)
    {
        $arr = $this->request->route();

        if (count($arr) < 2) {
            return;
        }

        $arr[1]['uses'] = $uses;

        // set route resolver
        $this->request->setRouteResolver(function () use ($arr) {
            return $arr;
        });
    }

    /**
     * extracts namespace based on a given classname
     *
     * @param  string $classname
     *
     * @return string
     */
    protected function extractNamespace($classname)
    {
        return Str::substr($classname, 0, strrpos($classname, '\\'));
    }

    /**
     * extract version from request Accept Header
     *
     * @return string
     */
    protected function getVersionFromAcceptHeader()
    {
        $accept  = $this->request->headers->get('accept');
        $version = $this->getFallbackVersion();

        // matches the pattern and capture the version requested
        if (preg_match('/' . $this->getAcceptHeaderPattern() . '/', $accept, $matches)) {
            $version = end($matches);
        }

        return $version;
    }

    /**
     * create a version namespace
     *
     * @param  integer $version
     * @param  string  $namespace
     *
     * @return string
     */
    protected function createVersionNamespace($version, $namespace)
    {
        if (! $namespace || ! $version) {
            return;
        }

        if (! Str::contains($namespace, $this->namespaceVersionPlaceholder)) {
            return preg_replace('/v[\d]+/i', "V{$version}", $namespace);
        }

        // remove previously set version
        return Str::replaceFirst(
            $this->namespaceVersionPlaceholder,
            $version,
            $namespace
        );
    }

    /**
     * replaces current namespace with versionized namespace
     *
     * @param  string $namespace
     * @param  string $versionNamespace
     * @param  string $classname
     *
     * @return string
     */
    protected function replaceNamespaceWithVersionNamespace(
        $namespace,
        $versionNamespace,
        $classname
    ) {
        return str_replace($namespace, $versionNamespace, $classname);
    }

    /**
     * check if controller under version namespace is callable
     *
     * @param  string  $classname
     *
     * @return boolean
     */
    protected function isControllerCallable($classname)
    {
        if (Str::contains($classname, '@')) {
            $arr = explode('@', $classname);
            $classname = $arr[0];
        }

        try {
            $controller = App::make($classname);
            return true;
        } catch (\Exception $ex) {
            // ..
        }
        return false;
    }

    /**
     * set request __version value
     *
     * @param string|integer           $version
     */
    protected function setRequestVersion($version)
    {
        $this->request->merge(['__version' => $version]);
    }

    /**
     * creates response object
     *
     * @throws \InvalidArgumentException
     *
     * @param  array|string             $content
     * @param  integer                  $status
     *
     * @return \Illuminate\Http\Response
     */
    protected function createResponse($content, $status = Response::HTTP_OK)
    {
        if (! is_array($content) && ! is_string($content)) {
            throw new \InvalidArgumentException(
                sprintf('argument 2 must be a string or array, %s given', gettype($content))
            );
        }

        if ($this->request->expectsJson()) {
            $content = $content;
            if (is_string($content)) {
                $content = ['message' => $content];
            }
            return response()->json($content, $status);
        }

        // converts array into string
        if (is_array($content)) {
            $content = implode(' ', $content);
        }

        return response($content, $status);
    }
}
