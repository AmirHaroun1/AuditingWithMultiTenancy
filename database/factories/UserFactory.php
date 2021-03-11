<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

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
    $roles = array('سكرتير','مراجع فنى','مدقق','مدير مراجعة','سكرتير تنفيذي');
    return [
        'NationalID' =>$faker->unique()->numerify('##########'),
        'name' => $faker->name,
        'phone' => $faker->unique()->numerify('##########'),
        'email' => $faker->unique()->safeEmail,
        'role'=> $faker->randomElement($roles),
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
    ];
});
