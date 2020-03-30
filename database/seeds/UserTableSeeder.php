<?php

use App\Loja;
use App\User;
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
        /*\Illuminate\Support\Facades\DB::table('users')->insert([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => '123456789',
        ]);*/

        factory(User::class, 30)->create()->each(function (User $user){
            $user->loja()->save(factory(Loja::class)->make());
        });
    }
}
