<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Faker\Factory;

$factory->define(User::class, function (Faker $faker) {
    $faker = Factory::create('pt_BR');
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'verified' => 0,
        'access' => 'Autor',
        'password' => bcrypt('123456'),
        'remember_token' => Str::random(10),
    ];
});
