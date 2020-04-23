<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Produto extends Model
{
    protected $fillable = ['nome', 'descricao', 'body', 'preco','slug', 'loja_id'];

    use HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nome')
            ->saveSlugsTo('slug');
    }

    public function loja()
    {
        return $this->belongsTo(Loja::class);
    }

    public function categoria()
    {
        return $this->belongsToMany(Categoria::class, 'categoria_produtos');
    }

    public function fotos()
    {
        return $this->hasMany(ProdutoFoto::class);
    }
}
