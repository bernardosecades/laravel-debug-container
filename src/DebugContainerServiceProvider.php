<?php
namespace BernardoSecades\Laravel\DebugContainer;

use Illuminate\Support\ServiceProvider;

class DebugContainerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                DebugContainerCommand::class
            ]);
        }
    }
}
