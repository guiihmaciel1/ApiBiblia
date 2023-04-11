<?php

namespace Database\Seeders;

use App\Models\Testamento;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TestamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Testamento::create(['nome' => 'Velho Testamento']);
        Testamento::create(['nome' => 'Novo Testamento']);
    }
}
