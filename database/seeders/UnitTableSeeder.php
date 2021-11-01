<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UnitTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'unit-create'
        ]);

        Permission::create([
            'name' => 'unit-list'
        ]);

        Permission::create([
            'name' => 'unit-edit'
        ]);

        Permission::create([
            'name' => 'unit-delete'
        ]);

        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['unit-create','unit-list','unit-edit','unit-delete']);

        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['unit-create','unit-list','unit-edit']);

        $adminUser = Role::findByName('Employee');
        $adminUser->givePermissionTo(['unit-create','unit-list']);
    }
}
