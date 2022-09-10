<?php 

namespace App\Services\Task\Data;

use App\Services\Task\Contract\TaskProviderContract;

class TaskProviderOne extends TaskProvider implements TaskProviderContract
{
    public function __construct()
    {
        $this->url = config('services.taskProviders.provider1');
    }

    public function execute() 
    {
        return $this->fetchAll();
    }

    public function transform(array $data): array
    {
        
        return collect($data)->map(function($item){
            return [
                'name' => $item['id'],
                'provider' => self::class,
                'level' => $item['zorluk'],
                'estimated_duration' => $item['sure']
            ];
        })->toArray();
    }
}