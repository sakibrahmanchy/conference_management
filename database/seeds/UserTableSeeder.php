<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $email = "super_admin@conf_master.com";
        $password = bcrypt("super!admin");
        $name = "Super Admin";

        $user = new \App\User();
        $user->email = $email;
        $user->name = $name;
        $user->password = $password;
        $user->user_type = 0;
        $user->status = 1;

        $user->save();

    }
}
