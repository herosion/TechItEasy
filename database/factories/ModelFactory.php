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

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' 			 => $faker->name,
        'email' 		 => $faker->email,
        'password' 		 => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Question::class, function (Faker\Generator $faker) {
    return [
        'level' 		 => rand(1, 3), 
	    'label' 		 => $faker->text(60).'?', 
	    'description' 	 => $faker->text(100),
	    'user_id' 		 => 1,
	    'category_id' 	 => rand(1, 3)
    ];
});

$factory->define(App\Models\Questionnaire::class, function (Faker\Generator $faker) {
    return [
        'title' 		 => 'Q - '.$faker->lastName, 
	    'user_id' 		 => 1 
    ];
});

