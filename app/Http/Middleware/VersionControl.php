<?php
/**
 * API Version Control class implementing versioning in request api
 * which will changed the current request to a specified version
 * this will read the Content-type and Accept Headers
 *
 * @author Mike Alvarez <mike@hallohallo.ph>
 */

namespace App\Http\Middleware;

use App\Libraries\Versioning\VersionControlInterface;
use Illuminate\Http\Request;
use Closure;

class VersionControl
{
    /**
     * @var \App\Libraries\Versioning\VersionControlInterface
     */
    protected $versionControl;

    /**
     * class constructor
     *
     * @param \App\Libraries\Versioning\VersionControlInterface $versionControl
     */
    public function __construct(VersionControlInterface $versionControl)
    {
        $this->versionControl = $versionControl;
    }

    /**
     * handles incoming request
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure                 $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // process version namespacing
        $this->versionControl->processRequestVersioning($request);

        return $next($request);
    }
}

