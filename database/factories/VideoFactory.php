<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Video;
use Faker\Generator as Faker;

$factory->define(Video::class, function (Faker $faker) {
    return [
        'title' => $faker->title(),
        'description' => $faker->text(),
        'thumbnail' => $faker->imageUrl(),
        'url' => $faker->url(),
    ];
});