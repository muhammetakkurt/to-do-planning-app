<?php 

namespace App\Services\Task\Data;

use App\Services\Task\Contract\TaskProviderContract;

class TaskProviderTwo extends TaskProvider implements TaskProviderContract
{
    public function __construct()
    {
        $this->url = config('services.taskProviders.provider2');
    }

    public function execute(): array
    {
        return $this->fetchAll();
    }

    public function transform(array $data): array
    {
        
        return collect($data)->map(function($item){
            $key = array_key_first($item);
            return [
                'name' => $key,
                'provider' => self::class,
                'level' => $item[$key]['level'],
                'estimated_duration' => $item[$key]['estimated_duration']
            ];
        })->toArray();
    }
}