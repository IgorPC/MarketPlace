<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdemUsuarios extends Model
{

    protected $fillable = ['referencia', 'pagseguro_status', 'pagseguro_code', 'items', 'loja_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function loja()
    {
        return $this->belongsTo(Loja::class);
    }

    public function lojas()
    {
        return $this->belongsToMany(Loja::class, 'loja_ordem', 'ordem_id');
    }
}
