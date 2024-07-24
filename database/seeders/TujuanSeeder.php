<?php

namespace Database\Seeders;

use App\Models\Tujuan;
use Illuminate\Database\Seeder;

class TujuanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tujuan::create([
            'tujuan' => 'Jakarta',
            'harga' => 95000,
        ]);
    }
}
