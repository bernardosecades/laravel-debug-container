<?php

namespace App\Console;

use BernardoSecades\Laravel\DebugContainer\DebugContainerCommand;
use Laravel\Lumen\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        DebugContainerCommand::class,
    ];
}
