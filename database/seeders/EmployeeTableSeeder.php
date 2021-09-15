<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'employee-list'
        ]);
        Permission::create([
            'name' => 'employee-create'
        ]);
        Permission::create([
            'name' => 'employee-edit'
        ]);
        Permission::create([
            'name' => 'employee-delete'
        ]);

        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['employee-list','employee-create','employee-edit','employee-delete']);
    }
}
