<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    public function run()
    {
        //----------------------------------------------------
        DB::table('permissions')->delete();

        // Install Permissions
        $acl = new \App\Http\Middleware\ACLPermissions;
        $acl->setupRoutes();

    }
}
