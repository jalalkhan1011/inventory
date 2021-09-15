<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'profile-list'
        ]);
        Permission::create([
            'name' => 'profile-create'
        ]);
        Permission::create([
            'name' => 'profile-edit'
        ]);
        Permission::create([
            'name' => 'profile-delete'
        ]);

        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['profile-create','profile-edit']);

        $adminUser = Role::findByName('Employee');
        $adminUser->givePermissionTo(['profile-create','profile-edit']);
    }
}
