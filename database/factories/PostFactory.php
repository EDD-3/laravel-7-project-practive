<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        //Relating data
        'user_id'=> factory(User::class),
        'title'=>$faker->sentence,
        'post_image'=>$faker->imageUrl('900','300'),
        'body'=>$faker->paragraph(3),
        
    ];
});
