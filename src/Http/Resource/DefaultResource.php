<?php

namespace Orangesix\Http\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DefaultResource extends JsonResource
{
    /**
     * Transforme os dados para ser utilizados
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        if (method_exists($this->resource, 'getAttributes')) {
            $data = $this->resource->getAttributes();
        } elseif (is_int($this->resource?->id)) {
            $data = (array) $this->resource;
        }
        return array_merge($data);
    }
}
