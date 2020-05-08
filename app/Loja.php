<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Loja extends Model
{

    protected $fillable = ['nome', 'descricao', 'telefone', 'celular','slug', 'logo', 'email'];

    use HasSlug;

    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('nome')
            ->saveSlugsTo('slug');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }

    public function ordens()
    {
        return $this->belongsToMany(OrdemUsuarios::class, 'loja_ordem', 'loja_id', 'ordem_id');
    }

    public function notificarDonoLojas($lojaID)
    {
        $lojas = Loja::whereIn('id', $lojaID)->get();

        $lojas->map(function($loja){
            return $loja->user;
        })->each->notify(new \App\Notifications\LojaRecebeNovaOrdem());
    }
}
