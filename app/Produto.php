<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'body', 'preco','slug'];

    public function loja()
    {
        return $this->belongsTo(Loja::class);
    }

    public function categoria()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_produtos');
    }
}
