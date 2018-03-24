<?php

namespace Tests;

use Illuminate\Console\Application;
use Illuminate\Support\Facades\Artisan;
use Laravel\Lumen\Testing\TestCase;

class DebugContainerCommandTest extends TestCase
{
    /**
     * Creates the application.
     *
     * @return Application
     */
    public function createApplication()
    {
        return require __DIR__ . '/../bootstrap/app.php';
    }

    public function testOutput()
    {
        Artisan::call('debug:container');
        $resultAsText = Artisan::output();

        $this->assertRegexp('/51 bindings founded/', $resultAsText);
    }
}