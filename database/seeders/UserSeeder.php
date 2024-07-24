<?php

namespace Database\Seeders;

use App\Models\User;
use App\Http\Controllers\AuthController;
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
        User::create([
            'name' => 'Iqbal Firdaus',
            'email' => 'iqbal@gmail.com',
            'password' => bcrypt('12345678'),
            'type' => 'admin',
        ]);

        User::create([
            'name' => 'Agustiar Fajar Abdillah',
            'email' => 'agus@gmail.com',
            'password' => bcrypt('12345678'),
            'type' => 'user',
        ]);

        User::create([
            'name' => 'Rian Arzial',
            'email' => 'rian@gmail.com',
            'password' => bcrypt('12345678'),
            'type' => 'supir',
        ]);
    }
}
