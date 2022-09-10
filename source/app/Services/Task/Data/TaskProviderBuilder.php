<?php 

namespace App\Services\Task\Data;

use App\Models\Task;
use App\Services\Task\Contract\TaskProviderContract;

class TaskProviderBuilder{
    
    public function execute(TaskProviderContract $taskProvider){
        return Task::insert($taskProvider->execute());
    }
}