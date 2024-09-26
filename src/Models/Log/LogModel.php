<?php

namespace Orangesix\Models\Log;

use Illuminate\Database\Eloquent\Model;

class LogModel extends Model
{
    /** @var string */
    protected $table = 'log';

    /** @var string */
    protected $connection = 'mysql';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->table = env('LOG_DB', 'log');
        $this->connection = env('DB_CONNECTION', 'mysql');
    }
}