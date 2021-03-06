<?php

use App\Models\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;
use App\Models\Book;
use App\Models\Department;
use App\Models\Category;
use App\Models\Accesslevel;
use App\Models\BookUser;

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
$factory->define(Department::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(Accesslevel::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'max_number_of_books_allowed' => 3,
        'status' => $faker->boolean,
        'department_id' => $faker->numberBetween($min = 1, $max = 5),
        'accesslevel_id' => $faker->numberBetween($min = 1, $max = 2)
    ];
});

$factory->define(Category::class, function (Faker $faker) {
    return [
        'name' => $faker->word
    ];
});


$factory->define(Book::class, function (Faker $faker) {
    return [
        'title' => $faker->word,
        'author' => $faker->name,
        'status' => $faker->boolean,
        'reservor_id' => $faker->optional()->numberBetween($min = 1, $max = 10),
        'category_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

$factory->define(BookUser::class, function (Faker $faker) {
    return [
            'date_out' => $faker->dateTimeBetween($startDate = '-1 month', $endDate = 'now', $timezone = null),
            'date_in' => $faker->optional()->dateTimeThisMonth($max = 'now', $timezone = null),
            'due_date' => $faker->dateTimeBetween($startDate = '-1 month', $endDate = '+1 month', $timezone = null),
            'book_id' => $faker->numberBetween($min = 1, $max = 10),
            'user_id' => $faker->numberBetween($min = 1, $max = 10),
    ];
});
