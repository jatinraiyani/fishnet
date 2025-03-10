<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = new User();
        $superAdmin->name = 'Super Admin';
        $superAdmin->email = 'superadmin@fishnet.com';
        $superAdmin->password = Hash::make('superadmin#super123!');
        $superAdmin->contact = 4569631595;
        $superAdmin->role = 'admin';
        $superAdmin->save();

    }
}
