<?php

namespace App\Providers;

use App\Categoria;
use Illuminate\Support\ServiceProvider;

class ComposerProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {

        $FilterCategorias = Categoria::all('nome', 'slug');

        view()->composer('*', function ($view) use ($FilterCategorias){
            $view->with('FilterCategorias', $FilterCategorias);
        });
    }
}
