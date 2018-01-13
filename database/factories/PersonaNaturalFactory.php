<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\PersonaNatural::class, function (Faker $faker) {

    return [
        'sexo' => $faker->randomElement(['masculino', 'femenino']),
        'nombres' => $faker->name,
        'estado_civil' => $faker->randomElement(['casado', 'soltero']),
        'fecha_nacimiento' => $faker->date,
        'edad' => $faker->randomDigit
    ];
});
