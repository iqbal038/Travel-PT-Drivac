<?php

namespace Database\Seeders;

use App\Models\Supir;
use App\Http\Controllers\SupirController;
use Illuminate\Database\Seeder;

class SupirSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Supir::create([
            'nama_supir' => 'Rian Arzial',
            'id_user' => 3,
        ]);
    }
}
