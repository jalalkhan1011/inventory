<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProductTaleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'product-list'
        ]);
        Permission::create([
            'name' => 'product-create'
        ]);
        Permission::create([
            'name' => 'product-edit'
        ]);
        Permission::create([
            'name' => 'product-delete'
        ]);

        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['product-list','product-create','product-edit','product-delete']);

        $adminUser = Role::findByName('Manager');
        $adminUser->givePermissionTo(['product-list','product-create','product-edit']);

        $adminUser = Role::findByName('Manager');
        $adminUser->givePermissionTo(['product-list','product-create']);
    }
}
