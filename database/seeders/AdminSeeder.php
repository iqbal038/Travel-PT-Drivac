<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Http\Controllers\AdminController;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = Admin::create([
            'nama_admin' => 'rian',
            'ttl_admin' => '2000-08-09',
            'no_telpon_admin' => '085793707717',
        ]);
    }
}
