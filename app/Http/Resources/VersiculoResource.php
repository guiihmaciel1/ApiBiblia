<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class VersiculoResource extends JsonResource
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
            'capitulo' => $this->capitulo,
            'versiculo' => $this->versiculo,
            'texto' => $this->texto,
            'livro' => new LivroResource($this->whenLoaded('livro')),
            'links' => [
                [
                    'rel' => 'Alterar um versiculo',
                    'type' => 'PUT',
                    'link' => route('versiculo.update', $this->id),
                ],
                [
                    'rel' => 'Excluir um versiculo',
                    'type' => 'DELETE',
                    'link' => route('versiculo.destroy', $this->id),
                ]

            ]
        ];
    }
}
