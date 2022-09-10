<?php 

namespace App\Services\Task\Data;

use Illuminate\Support\Facades\Http;

abstract class TaskProvider
{
    protected $url;

    protected function fetchAll(): array
    {
        $providerTasks = Http::get($this->url)->json();
        return $this->transform($providerTasks);
    }

    abstract public function transform(array $data): array;
}