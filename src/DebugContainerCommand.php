<?php

namespace BernardoSecades\Laravel\DebugContainer;

use Illuminate\Console\Command;
use Illuminate\Console\Application;
use Illuminate\Contracts\Container\Container;

class DebugContainerCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'debug:container';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Displays current bindings in the container';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $container = $this->getContainer();
        $bindings  = $container->getBindings();
        $this->output->note(count( $bindings ). ' bindings founded' );
        $headers = [ 'Key', 'Class', 'shared', 'Time'];
        $rows    = [ ];

        foreach ( array_keys($bindings) as $key) {
            try {
                $before = microtime(true);
                $className = get_class($this->getContainer()->make($key));
                $time = microtime(true) - $before;
            } catch (\Throwable $e) {
                $className = '??';
                $time = '??';
            }

            $rows[] = [
                $key,
                $className,
                $this->getContainer()->isShared($key) ? 'Yes' : 'No',
                $time
            ];
        }

        sort($rows);
        $this->table( $headers, $rows);
    }

    /**
     * @return Container
     */
    private function getContainer() {
        /** @var Application $app */
        $app = $this->getApplication();

        return $app->getLaravel();
    }
}
