<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

//$factory->define(App\User::class, function ($faker) {
//    return [
//        'name' => $faker->name,
//        'email' => $faker->email,
//        'password' => str_random(10),
//        'remember_token' => str_random(10),
//    ];
//});

$factory->define(App\Categorie::class, function ($faker) {
	return [
		'nom' => rand(1, 12)
	];
});

$factory->define(App\Operation::class, function ($faker) {
	return [
		'produit_id'	=> rand(1, 50),
		'quantite'		=> rand(0, 5),
		'operation'		=> ((rand(1, 10) % 2) == 1 ? '+' : '-'),
		'detail'		=> str_random( rand(5, 32) )
	];
});
