<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Produto;
use Faker\Generator as Faker;

$factory->define(Produto::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'descricao' => $faker->sentence,
        'body' => $faker->paragraph(3, true),
        'preco' => $faker->randomFloat(null, 0, 5),
        'slug' => $faker->slug
    ];
});
