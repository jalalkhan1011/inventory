<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'user-list'
        ]);
        Permission::create([
            'name' => 'user-create'
        ]);
        Permission::create([
            'name' => 'user-edit'
        ]);
        Permission::create([
            'name' => 'user-delete'
        ]);

        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['user-list','user-create','user-edit','user-delete']);
    }
}
