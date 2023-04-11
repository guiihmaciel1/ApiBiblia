<?php

namespace App\Http\Controllers;

use App\Models\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Idioma::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (Idioma::create($request->all())) {
            return response()->json([
                'message'=>'Idioma cadastrado com sucesso'
            ],201);
        }

        return response()->json([
                'message'=>'Erro ao cadastrar o idioma'
        ],404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $idioma)
    {
        $idioma = Idioma::find($idioma);
        if ($idioma) {
            $idioma->versoes;
            return $idioma;
        }

        return response()->json([
            'message'=>'Erro ao pesquisar o idioma'
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $idioma)
    {
        $idioma = Idioma::find($idioma);

        if ($idioma) {
            $idioma->update($request->all());

            return $idioma;
        }
        return response()->json([
            'message'=>'Erro ao atualizarr o idioma'
        ],404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $idioma)
    {
        if (Idioma::destroy($idioma)) {
            return response()->json([
                'message' => ' Idioma Deletado com Sucesso.'
            ], 201);
        }

        return response()->json([
            'mesage' => 'Erro ao Deletar o Idioma.'
        ],404);
    }
}
