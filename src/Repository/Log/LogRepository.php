<?php

namespace Orangesix\Repository\Log;

use Orangesix\Models\Log\LogModel;
use Orangesix\Repository\Repository;
use Orangesix\Repository\RepositoryDataBase;

/**
 * Repository - Log
 */
class LogRepository implements Repository
{
    use RepositoryDataBase;

    /** @var LogModel */
    private LogModel $model;

    public function __construct(LogModel $model)
    {
        $this->model = $model;
    }
}