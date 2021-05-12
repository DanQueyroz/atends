<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Carlos Almeida',
            'email'     => 'gestor@gestor.com',
            'password'  =>  bcrypt('1234'),
            'role'      =>  0,
        ]);
        User::create([
            'name'      => 'Eduardo Abuquerque',
            'email'     => 'tecnico@tecnico.com',
            'password'  =>  bcrypt('1234'),
            'role'      =>  1,
        ]);
        User::create([
            'name'      => 'Angela Martins',
            'email'     => 'tecnico2@tecnico.com',
            'password'  =>  bcrypt('1234'),
            'role'      =>  1,
        ]);
        User::create([
            'name'      => 'Gustavo ima',
            'email'     => 'tecnico3@tecnico.com',
            'password'  =>  bcrypt('1234'),
            'role'      =>  1,
        ]);
        User::create([
            'name'      => 'Robson Cavalcante',
            'email'     => 'tecnico4@tecnico.com',
            'password'  =>  bcrypt('1234'),
            'role'      =>  1,
        ]);
    }
}
