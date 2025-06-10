<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::create(['name' => 'dashboard.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'dashboard.sales_chart', 'guard_name' => 'web']);
        Permission::create(['name' => 'dashboard.sales_today', 'guard_name' => 'web']);
        Permission::create(['name' => 'dashboard.profits_today', 'guard_name' => 'web']);
        Permission::create(['name' => 'dashboard.best_selling_product', 'guard_name' => 'web']);
        Permission::create(['name' => 'dashboard.product_stock', 'guard_name' => 'web']);

        Permission::create(['name' => 'user.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'user.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'roles.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'roles.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'permissions.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'categories.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'categories.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'categories.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'categories.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'products.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'products.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'products.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'products.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'customers.index', 'guard_name' => 'web']);
        Permission::create(['name' => 'customers.create', 'guard_name' => 'web']);
        Permission::create(['name' => 'customers.edit', 'guard_name' => 'web']);
        Permission::create(['name' => 'customers.delete', 'guard_name' => 'web']);

        Permission::create(['name' => 'transactions.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'sales.index', 'guard_name' => 'web']);

        Permission::create(['name' => 'profits.index', 'guard_name' => 'web']);
    }
}
