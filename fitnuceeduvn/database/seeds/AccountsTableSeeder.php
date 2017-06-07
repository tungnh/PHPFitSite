<?php

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('accounts')->insert([
            'username' => 'TungNH',
            'email' => 'nguyenhuutung.nuce@gmail.com',
            'password' => '$2y$10$H5W6beEKNGR0s88sgYY4K.3XWIZNZbE0oNkM26shxAAoP7fxvH01C',
            'is_active' => 1,
            'is_delete' => 1
        ]);
    }
}
