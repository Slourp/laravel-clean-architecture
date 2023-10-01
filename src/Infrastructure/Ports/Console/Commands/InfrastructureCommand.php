<?php

namespace Infrastructure\Ports\Console\Commands;


use Illuminate\Console\Command;

class InfrastructureCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'infrastructure:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        dd("INFRASTRUCTURE");
    }
}
