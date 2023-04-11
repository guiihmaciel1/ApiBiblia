<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Versao extends Model
{
    use HasFactory;

    protected $table = 'versoes';

    protected $fillable = ['nome', 'abreviacao', 'idioma_id'];

    //pega o idioma

    public function idioma()
    {
        return $this->belongsTo(Idioma::class);
    }

    //pega o livro

    public function livros()
    {
        return $this->hasMany(Livro::class);
    }
}
