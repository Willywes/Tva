<?php

use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});

$factory->define(\App\Models\ProductCategory::class, function (Faker $faker) {
    $name = $faker->firstName;
    return [
        'image' => $faker->imageUrl(),
        'name' => $name,
        'slug' => Str::slug($name),
        'description' => $faker->text,
        'parent' => 0
    ];
});

$factory->define(\App\Models\Product::class, function (Faker $faker) {
    $name = $faker->firstName;
    return [
        'image' => $faker->imageUrl(),
        'name' => $name,
        'slug' => Str::slug($name),
        'description' => $faker->text,
        'sku' => $faker->ean13,
        'normal_price' => $faker->randomNumber(4),
        'product_category_id' => $faker->numberBetween(0, 10)
    ];
});

