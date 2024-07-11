<?php

namespace Orangesix\Http\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SelectResource extends JsonResource
{
    /**
     * Transforme os dados para ser utilizados no FORM SELECT
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $data = [];
        if (method_exists($this->resource, 'getAttributes')) {
            $data = $this->resource->getAttributes();
        }

        return array_merge($data, [
            'id' => $this->id,
            'name' => $this->descricao ?? ''
        ]);
    }
}
