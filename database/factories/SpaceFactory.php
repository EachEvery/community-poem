<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use Display\Space;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Space::class, function (Faker $faker) {
    $name = $faker->name;

    $emails = collect(range(1, $faker->numberBetween(1, 5)))->map(function () use ($faker) {
        return $faker->email;
    });

    return [
        'name' => $name,
        'slug' => Str::slug($name),
        'admin_emails' => $emails->implode(', '),
        'slideshow_interval' => 8,
    ];
});
