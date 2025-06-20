<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\UserResource;
use App\Http\Resources\BloqueResource;
use App\Http\Resources\ProyectoResource;

class PiezaResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'codigo' => $this->codigo,
            'pieza' => $this->pieza,
            'peso_teorico' => $this->peso_teorico,
            'peso_real' => $this->peso_real,
            'estado' => $this->estado,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,

            'user' => UserResource::make($this->whenLoaded('user')),
            'bloque' => BloqueResource::make($this->whenLoaded('bloque')),
            'proyecto' => ProyectoResource::make($this->whenLoaded('bloque.proyecto')),
        ];
    }
}
