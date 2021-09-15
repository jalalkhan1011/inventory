<?php

namespace Database\Seeders;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class EmployeeUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Arman Khan',
            'email' => 'arman@gmail.com',
            'password' => bcrypt('123456789')
        ]);

        $role = Role::create(['name' => 'Employee']);

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



        $role->givePermissionTo(['customer-list','customer-create']);

        $user->assignRole([$role->id]);
        $adminUser = Role::findByName('Admin');
        $adminUser->givePermissionTo(['customer-list','customer-create','customer-edit','customer-delete']);

        $data = [
            'name' => $user->name,
            'email' => $user->email,
            'employee_id' => $user->id,
            'user_id' => 1
        ];

        Employee::create($data);

    }
}
