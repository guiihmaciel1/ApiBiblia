<?php

namespace App\Http\Controllers;

use App\Models\Testamento;
use Illuminate\Http\Request;

class TestamentoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Testamento::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ( Testamento::create($request->all()) ){
            return response()->json([
                'message' => ' Testamento Cadastrado com Sucesso.'
            ], 201);
        }

        return response()->json([
            'mesage' => 'Erro ao Cadastrar o Testamento.'
        ],404);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $testamento)
    {
        $testamento = Testamento::find($testamento);

        if ($testamento) {
            // $response = [
            //         'testamento' => $testamento,
            //         'livros' => $testamento->livros
            // ];
            $testamento->livros;
            return $testamento;
        }

        return response()->json([
            'mesage' => 'Erro ao Pesquisar o Testamento.'
        ],404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $testamento)
    {
        $testamento = Testamento::find($testamento);
        if ($testamento) {
            $testamento->update($request->all());

            return $testamento;
        }

        return response()->json([
            'mesage' => 'Erro ao Atualizar o Testamento.'
        ],404);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $testamento)
    {
        if (Testamento::destroy($testamento)) {
            return response()->json([
                'message' => ' Livro Deletado com Sucesso.'
            ], 201);
        }

        return response()->json([
            'mesage' => 'Erro ao Deletar o Livro.'
        ],404);
    }
}
