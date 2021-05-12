<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TipoAtendimento;

class TiposAtendimentosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i < 10; $i++) { 
            TipoAtendimento::create([
                'nome'      => 'Tipo '.$i,
            ]);
        }
    }
}
