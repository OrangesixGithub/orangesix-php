<?php

namespace Orangecode\Helpers\Exceptions;
use Illuminate\Http\JsonResponse;

class Api extends \Exception
{
    /**
     * @return JsonResponse
     */
    public function render(): JsonResponse
    {
        $details = [];
        $data = json_decode($this->getMessage());
        if (!empty($data))
            foreach ($data as $key => $error)
                $details[$key] = $error[0];
        return response()->json([
            "message" => empty($data) ? $this->getMessage() : $details,
            "status" => $this->getCode()
        ], $this->getCode());
    }
}
