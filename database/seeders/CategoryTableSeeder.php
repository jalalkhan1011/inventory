<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'category-list'
        ]);
        Permission::create([
            'name' => 'category-create'
        ]);
        Permission::create([
            'name' => 'category-edit'
        ]);
        Permission::create([
            'name' => 'category-delete'
        ]);

        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['category-list','category-create','category-edit','category-delete']);

        $adminUser = Role::findByName('Manager');
        $adminUser->givePermissionTo(['category-list','category-create']);
    }
}
