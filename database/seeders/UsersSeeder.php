<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //criar um novo usuario 
        User::create([
            'name' => 'Marcel Leite de Farias',
            'email' => 'marcel.leitefarias@gmail.com',
            'password' => bcrypt('123456'),
        ]);
    }
}
