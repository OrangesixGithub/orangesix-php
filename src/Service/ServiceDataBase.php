<?php

namespace Orangecode\Helpers\Service;

use Illuminate\Support\Facades\DB;

trait ServiceDataBase
{
    /**
     * @param string $callback
     * @param mixed|null $param
     * @return mixed
     */
    protected function dbExecute(string $callback, mixed $param = null): mixed {
        try {
            DB::beginTransaction();
            if (method_exists($this, $callback))
                $return = $this->$callback($param);
            else
                $return = $this->repository->$callback($param);
            DB::commit();
            return $return;
        } catch (\Exception $exception) {
            DB::rollBack();
            return null;
        }
    }
}
