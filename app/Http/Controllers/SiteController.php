<?php

namespace App\Http\Controllers;

use App\Models\Versiculo;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        $versiculoDoDia = Versiculo::with(['livro'])->find(rand(1,401));
        return response()->json($versiculoDoDia, 201);
    }

    public function ler_a_biblia($versao, $livro = null, $capitulo = null, $versiculo = null)
    {
        $versiculos = Versiculo::whereHas('livro',function($query) use ($versao, $livro){
            //$query->where('versao_id', $versao);
            $query->whereHas('versao', function($query) use ($versao){
                $query->where('abreviacao', $versao);
            });
            $query->when($livro, function($query) use ($livro){
                $query->where('abreviacao', $livro);
            });
        })->filters(['capitulo' => $capitulo, 'versiculo' => $versiculo])->get();

        return response()->json($versiculos, 201);
    }
}
