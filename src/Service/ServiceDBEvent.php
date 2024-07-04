<?php

namespace Orangesix\Service;

interface ServiceDBEvent
{
    /**
     * @param ...$paramns
     * @return void
     */
    public function beforeManager(...$paramns): void;

    /**
     * @param ...$paramns
     * @return void
     */
    public function afterManager(...$paramns): void;

    /**
     * @param ...$paramns
     * @return void
     */
    public function beforeDelete(...$paramns): void;

    /**
     * @param ...$paramns
     * @return void
     */
    public function afterDelete(...$paramns): void;
}