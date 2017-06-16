<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$admin = DB::table('users')->insert([
            'login' => 'admin',
            'email' => 'lemee.benjamin@hotmail.fr'
            'password' => bcrypt('toor'),
        ]);

        /*$admin->questions()->sync([1, 2]);
        $admin->save();*/
    }
}
