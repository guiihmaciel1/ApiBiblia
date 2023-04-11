<?php

namespace App\Http\Controllers;

use App\Http\Resources\LivroResource;
use App\Http\Resources\LivrosCollection;
use App\Models\Livro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LivroController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new LivrosCollection(Livro::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ( Livro::create($request->all()) ){
            return response()->json([
                'message' => ' Livro Cadastrado com Sucesso.'
            ], 201);
        }

        return response()->json([
            'mesage' => 'Erro ao Cadastrar o Livro.'
        ],404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $livro)
    {
        $livro = Livro::with('testamento','versiculos','versao')->find($livro);
        // dd(Storage::disk('public')->url($livro->capa));
        // php artisan storage:link
        if ($livro) {
            // $response = [
            //     'livro'  => $livro,
            //     'testamento' => $livro->testamento,
            //     'versiculos' => $livro->versiculos,
            // ];
            // $livro->testamento;
            // $livro->versiculos;
            // $livro->versao;
            return new LivroResource($livro);
        }

        return response()->json([
            'mesage' => 'Erro ao Pesquisar o Livro.'
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $livro)
    {
        // dd($request->capa->getClientOriginalName());
        $path = $request->capa->store('capa_livro','public');

        $livro = Livro::find($livro);
        if ($livro) {
            $livro->capa = $path;

            if ($livro->save()) {
                return $livro;
            }

            return response()->json([
                'mesage' => 'Erro ao Atualizar o Livro.'
            ],404);

        }

        return response()->json([
            'mesage' => 'Erro ao Atualizar o Livro.'
        ],404);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $livro)
    {
        if (Livro::destroy($livro)) {
            return response()->json([
                'message' => ' Livro Deletado com Sucesso.'
            ], 201);
        }

        return response()->json([
            'mesage' => 'Erro ao Deletar o Livro.'
        ],404);
    }
}
