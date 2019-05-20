<?php
/**
 * trait class for version control usable in controllers
 *
 * @author Mike Alvarez <mike@hallohallo.ph>
 */

namespace App\Http\Concerns;

use Illuminate\Http\Request;

trait VersionControl
{
    /**
     * get current request api version
     *
     * @param  \Illuminate\Http\Request|null $request
     *
     * @return string
     */
    public function getVersion(Request $request = null)
    {
        if (is_null($request)) {
            $request = app('request');
        }
        return $request->get('__version');
    }
}
