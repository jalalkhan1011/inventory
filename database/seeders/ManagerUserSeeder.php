<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class ManagerUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Masud khan',
            'email' => 'Masud53@ymail.com',
            'password' => bcrypt('123456789')
        ]);

        $role = Role::create(['name' => 'Manager']);

        $user->assignRole([$role->id]);
    }
}
