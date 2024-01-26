<?php

namespace Orangecode\Helpers\Exceptions;

use Illuminate\Http\JsonResponse;
use Orangecode\Helpers\Service\Response\Enum\Message as MessageEnum;

class Message extends \Exception
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        $type = match ($this->code) {
            404 => MessageEnum::Warning,
            default => MessageEnum::Error,
        };
        return response()->json([
            "message" => new \Orangecode\Helpers\Service\Response\Message($this->getMessage(), $type)
        ], $this->getCode());
    }
}
