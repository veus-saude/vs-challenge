<?php
/**
 * version control interface providing custom version control processor
 *
 * @author Mike Alvarez <mike@hallohallo.ph>
 */

namespace App\Libraries\Versioning;

use Illuminate\Http\Request;

interface VersionControlInterface
{
    /**
     * process request version control
     *
     * @return void
     */
    public function processRequestVersioning(Request $request = null);
}
