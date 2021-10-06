<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class ProductSaleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'product-sale-list'
        ]);
        Permission::create([
            'name' => 'product-sale-create'
        ]);
        Permission::create([
            'name' => 'product-sale-edit'
        ]);
        Permission::create([
            'name' => 'product-sale-delete'
        ]);

        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['product-sale-list','product-sale-edit','product-sale-delete']);

        $adminUser = Role::findByName('Manager');
        $adminUser->givePermissionTo(['product-sale-list','product-sale-edit','product-sale-delete']);

        $adminUser = Role::findByName('Employee');
        $adminUser->givePermissionTo(['product-sale-list','product-sale-create','product-sale-edit','product-sale-delete']);
    }
}
