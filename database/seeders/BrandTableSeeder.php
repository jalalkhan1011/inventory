<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'brand-list'
        ]);
        Permission::create([
            'name' => 'brand-create'
        ]);
        Permission::create([
            'name' => 'brand-edit'
        ]);
        Permission::create([
            'name' => 'brand-delete'
        ]);

        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['brand-list','brand-create','brand-edit','brand-delete']);

        $adminUser = Role::findByName('Manager');
        $adminUser->givePermissionTo(['brand-list','brand-create','brand-edit']);

        $adminUser = Role::findByName('Employee');
        $adminUser->givePermissionTo(['brand-list','brand-create']);
    }
}
