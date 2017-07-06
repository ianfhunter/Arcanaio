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
        DB::table('users')->insert([
            'name' => '5E SRD',
            'email' => 'admin@tokenofholding.com',
            'password' => bcrypt(str_random(40)),
            'id' => '1',
            'avatar' => '/img/avatar.jpg',
        ]);

        $user = factory(App\User::class, 50)->create();
    }
}
