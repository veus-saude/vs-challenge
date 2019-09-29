<?php

namespace Tests;

use Illuminate\Support\Facades\Artisan;

trait RefreshDatabaseOnce
{
    /**
     * If true, setup has run at least once.
     * @var boolean
     */
    protected static $setUpHasRunOnce = false;

    /**
     * Set up.
     * @return void
     */
    public function setUp(): void
    {
        parent::setUp();

        if (!static::$setUpHasRunOnce) {
            Artisan::call('migrate:fresh');
            Artisan::call(
                'db:seed', ['--class' => 'DatabaseTestingSeeder']
            );

            static::$setUpHasRunOnce = true;
        }
    }
}