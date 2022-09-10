<?php

namespace App\Services\Task\Contract;

interface TaskProviderContract{

    public function transform(array $data): array;

}