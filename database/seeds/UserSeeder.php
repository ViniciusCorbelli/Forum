<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 5)->create();
        User::updateOrCreate([
            'name' => 'Admin',
            'email' => 'admin@admin.com.br',
            'access' => 'Administrador',
            'verified' => 1,
        ],[
            'name' => 'Admin',
            'email' => 'admin@admin.com.br',
            'email_verified_at' => now(),
            'access' => 'Administrador',
            'password' => bcrypt('123456'),
            'image' => 'user.png',
            'verified' => 1,
        ]);
    }
}
