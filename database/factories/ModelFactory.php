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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
// $factory->define(App\User::class, function (Faker\Generator $faker) {
//     static $password;
//
//     return [
//         'name' => $faker->name,
//         'email' => $faker->unique()->safeEmail,
//         'password' => $password ?: $password = bcrypt('secret'),
//         'remember_token' => str_random(10),
//     ];
// });


use App\Domain\Recipe\Entities\Recipe;
use App\Domain\Schedule\Entities\Schedule;
use Carbon\Carbon;

$factory->define(Schedule::class, function (Faker\Generator $faker) {
    $isRecipe = $faker->boolean;
    $recipe = $isRecipe ? Recipe::inRandomOrder()->first() : null;
    $start_at = Carbon::createFromTimeStamp($faker->dateTimeBetween('-30 days', '+30 days')->getTimestamp());
    $end_at = Carbon::createFromFormat('Y-m-d H:i:s', $start_at)->addHours($faker->randomDigit);

    return [
        'recipe_id' => $isRecipe ? $recipe->id : null,
        'user_id' => '1',
        'type_schedule' => $isRecipe ? 'recette' : ($faker->boolean ? 'rendezvous' : 'planning'),
        'title' => $isRecipe ? $recipe->name : implode(' ', $faker->words),
        'details' => $faker->sentence,
        'start_at' => $start_at,
        'end_at' => $end_at,
        'all_day' => $isRecipe ? 0 : $faker->boolean,
    ];
});
