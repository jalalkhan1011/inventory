<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'supplier-list'
        ]);
        Permission::create([
            'name' => 'supplier-create'
        ]);
        Permission::create([
            'name' => 'supplier-edit'
        ]);
        Permission::create([
            'name' => 'supplier-delete'
        ]);

        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo('supplier-list','supplier-create','supplier-edit','supplier-delete');

        $adminUser = Role::findByName('Manager');
        $adminUser->givePermissionTo('supplier-list','supplier-create');
    }
}
