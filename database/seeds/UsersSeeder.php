<?php

use App\Fictionary\Auth\Role;
use App\Fictionary\Auth\User;
use App\Fictionary\Auth\Activation;
use App\Fictionary\Profiles\Profile;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Create a user admin and assign the admin role
        $adminRole = Role::where('name', 'admin')->first();

        $admin = User::create([
            'first_name' => 'Nizar',
            'last_name' => 'El Berjawi',
            'email' => 'nizarberjawi12@gmail.com',
            'password' => bcrypt('secret'),
        ]);

        $admin->roles()->attach($adminRole);

        $userRole = Role::where('name', 'user')->first();
        $user = User::create([
            'first_name' => 'Na',
            'last_name' => 'Li',
            'email' => 'na_li_@outlook.com',
            'password' => bcrypt('secret'),
        ]);
        $user->roles()->attach($userRole);

        // Create 50 regular users with activations
        factory(User::class, 50)->create()->each(function($user) {
            $user->roles()->attach(Role::where('name', 'user')->first());
            $user->activation()->save(factory(Activation::class)->make());

            if ($user->isActivated()) {
                $user->profile()->save(factory(Profile::class)->make([
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                ]));
            }
        });
    }
}
