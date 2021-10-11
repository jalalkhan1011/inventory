<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class CustomerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create([
            'name' => 'customer-list',
        ]);
        Permission::create([
            'name' => 'customer-create',
        ]);
        Permission::create([
            'name' => 'customer-edit',
        ]);
        Permission::create([
            'name' => 'customer-delete',
        ]);

        $adminUser = Role::findByName('Employee');
        $adminUser->givePermissionTo(['customer-list','customer-create']);
    }
}
