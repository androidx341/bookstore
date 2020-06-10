<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Book;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\DB;

$factory->define(Book::class, function (Faker $faker) {
    $authors = DB::table('authors')->pluck('id')->all();
    $users = DB::table('users')->pluck('id')->all();

    return [
        'title' => $faker->sentence(4),
        'pagesCount' => $faker->numberBetween(10, 300),
        'annotation' => $faker->text(500),
        'coverImage' => 'cover-' . time() . '.png',
        'authorId' => $authors[array_rand($authors)],
        'createBy' => $users[array_rand($users)],
    ];
});
