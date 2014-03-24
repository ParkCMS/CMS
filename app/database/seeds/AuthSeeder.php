<?php

class AuthSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Eloquent::unguard();
        
        // Create admin group
        $admin = Sentry::createGroup(array(
            'name'        => 'Admins',
            'permissions' => array(
                'admin' => 1,
                'users' => 1,
            ),
        ));

        $user = Sentry::createUser(array(
            'email'     => 'parkcms.team@gmail.com',
            'password'  => 'parkcms',
            'activated' => true,
            'first_name'=> 'ParkCMS',
            'last_name' => 'Team',
        ));

        $snduser = Sentry::createUser(array(
            'email'     => 'test@example.com',
            'password'  => 'parkcms',
            'activated' => true,
            'first_name'=> 'Test',
            'last_name' => 'User'
        ));

        $user->addGroup($admin);
        
    }

}