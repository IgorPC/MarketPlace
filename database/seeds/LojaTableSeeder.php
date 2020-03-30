<?php

use App\Loja;
use App\Produto;
use Illuminate\Database\Seeder;

class LojaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lojas = Loja::all();

        foreach ($lojas as $loja){
            $loja->produtos()->save(factory(Produto::class)->make());
        }
    }
}
