<?php

use App\Fictionary\Auth\Role;
use App\Fictionary\Auth\User;
use App\Fictionary\Auth\Activation;
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

        // Create 50 regular users with activations
        factory(User::class, 50)->create()->each(function($user) {
            $user->roles()->attach(Role::where('name', 'user')->first());
            $user->activation()->save(factory(Activation::class)->make());
        });
    }
}
