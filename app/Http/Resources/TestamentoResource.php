<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TestamentoResource extends JsonResource
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
            'nome' => $this->nome,
            'livros' => new LivrosCollection($this->whenLoaded('livros')),
            'links' => [
                [
                    'rel' => 'Alterar um testamento',
                    'type' => 'PUT',
                    'link' => route('testamento.update', $this->id),
                ],
                [
                    'rel' => 'Excluir um testamento',
                    'type' => 'DELETE',
                    'link' => route('testamento.destroy', $this->id),
                ]

            ]
        ];
    }
}
