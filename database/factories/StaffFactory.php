<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Staff;
use Faker\Generator as Faker;

$factory->define(Staff::class, function (Faker $faker) {
    return [
        'fname' 		=>	$faker->word,
        'lname'			=>	$faker->word,
        'department'	=>	$faker->numberBetween(1, App\Department::count()),
        'profile'		=>	$faker->paragraphs(1, true),
    ];
});
