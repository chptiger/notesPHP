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

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
    ];
});

//$factory->define(App\Provider::class, function ($faker) {
//    $title = $faker->sentence(rand(3, 10));
//
//    return [
//        'title' => substr($title, 0, strlen($title) - 1),
//        'description' => $faker->text,
//    ];
//});
////protected $fillable =['name', 'cn_name','code','image','is_h5','is_jackpot','jackpot','has_demo'];
//
//$factory->define(App\Game::class, function ($faker) {
//    return [
//        'name' => $faker->name,
//        'cn_name' => $faker->cn_name,
//        'code' => $faker->code,
//        'image' => $faker->image,
//        'is_h5' => $faker->is_h5,
//        'is_jackpot' => $faker->is_jackpot,
//        'jackpot' => $faker->jackpot,
//        'has_demo' => $faker->has_demo
//    ];
//});

