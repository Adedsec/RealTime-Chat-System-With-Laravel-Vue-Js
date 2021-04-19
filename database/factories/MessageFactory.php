<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use App\Model;
use App\User;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'body' => $faker->realText(),
        'user_id' => function () {
            return factory(User::class)->create()->id;
        }
    ];
});
