<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'      => 'Beatriz',
            'contact' => '(99) 9 9999-9999',
            'email'     => 'beatriz@gmail.com',
        ]);

        User::create([
            'name'      => 'Fulano',
            'contact' => '(88) 8 8888-8888',
            'email'     => 'fulano@hotmail.com',
        ]);

        User::create([
            'name'      => 'Ciclano',
            'contact' => '(77) 7 7777-7777',
            'email'     => 'ciclano@gmail.com',
        ]);

        User::create([
            'name'      => 'Beltrano',
            'contact' => '(66) 6 6666-6666',
            'email'     => 'beltrano@hotmail.com.com',
        ]);

        User::create([
            'name'      => 'Thais',
            'contact' => '(55) 5 5555-5555',
            'email'     => 'thais@gmail.com',
        ]);

        User::create([
            'name'      => 'João',
            'contact' => '(44) 4 4444-4444',
            'email'     => 'joao@hotmail.com',
        ]);
    }
}
