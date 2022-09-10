<?php

namespace App\Console\Commands;

use App\Services\Task\Data\TaskProviderBuilder;
use App\Services\Task\Data\TaskProviderOne;
use App\Services\Task\Data\TaskProviderTwo;
use Illuminate\Console\Command;

class ImportTaskCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tasks:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch provider tasks.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $taskProvider1 = (new TaskProviderBuilder)->execute(new TaskProviderOne());
        $taskProvider2 = (new TaskProviderBuilder)->execute(new TaskProviderTwo());

        return 0;
    }
}
