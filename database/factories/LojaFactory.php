<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Loja;
use App\Model;
use Faker\Generator as Faker;

$factory->define(Loja::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'descricao' => $faker->sentence,
        'telefone' => $faker->phoneNumber,
        'celular' => $faker->phoneNumber,
        'slug' => $faker->slug
    ];
});
