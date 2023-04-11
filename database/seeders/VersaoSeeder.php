<?php

namespace Database\Seeders;

use App\Models\Versao;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VersaoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Versao::create([
                        'nome' => 'Nova Versao Internacional',
                        'abreviacao' => 'NVI',
                        'idioma_id' => 1
                        ]);
    }
}
