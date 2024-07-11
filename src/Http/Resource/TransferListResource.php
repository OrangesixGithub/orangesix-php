<?php

namespace Orangesix\Http\Resource;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransferListResource extends JsonResource
{
    /**
     * Transforme os dados para ser utilizados no TRANFERSLIST
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $foreignKey = $request->foreignKey;
        $transferListActive = $request->transferListActive;

        return [
            'id' => $this->id,
            $foreignKey => $this->id,
            'label' => $this->descricao ?? $this->label,
            'active' => !is_bool($transferListActive->search(function ($value) use ($foreignKey) {
                return $this->id == $value->$foreignKey;
            }))
        ];
    }
}
