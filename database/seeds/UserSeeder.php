<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    protected $email;

    public function __construct($email)
    {
        $this->email = $email;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        DB::table('users')->insert([
            'name' => Str::random(10),
            'email' => $this->email,
            'password' => Hash::make('password'),
        ]);
    }
}
