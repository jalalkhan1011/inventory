<?php

namespace Database\Seeders;

use App\Models\Suppliers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        DB::table('permissions')->truncate();
        DB::table('users')->truncate();

        $this->call([
            PermissionTableSeeder::class,
            CreateAdminUserSeeder::class,
            UserTableSeeder::class,
            ManagerUserSeeder::class,
            EmployeeUserSeeder::class,
            ProfileTableSeeder::class,
            EmployeeTableSeeder::class,
            SupplierTableSeeder::class,
            CategoryTableSeeder::class,
            BrandTableSeeder::class,
        ]);
    }
}
