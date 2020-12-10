<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
       $permissions = [
           'role-view',
           'role-list',
           'role-create',
           'role-edit',
           'role-delete',
           'role-permission-list',
           'role-permission-edit',
           'customer-view',
           'customer-list',
           'customer-create',
           'customer-edit',
           'customer-delete',          
           'supplier-view',
           'supplier-list',
           'supplier-create',
           'supplier-edit',
           'supplier-delete',
           'product-view',
           'product-list',
           'product-create',
           'product-edit',
           'product-delete',
           'invoice-view',
           'invoice-list',
           'invoice-create',
           'invoice-edit',
           'invoice-delete',
           'invoice-download',         
           'user-view',
           'user-list',
           'user-create',
           'user-edit',
           'user-delete',
           'employee-view',
           'employee-list',
           'employee-create',
           'employee-edit',
           'employee-delete',
           'employee-salary',         
           'item-stock-view',       
           'invoice-item-return',
           'product-category-list',
           'product-category-edit',
           'product-category-view',
           'product-category-delete',
           'product-category-create',
           'receipt-download',
           'product-price-history',
           'bank-list',
           'bank-create',
           'bank-edit',
           'bank-delete',
           'bank-branch-list',
           'branch-list',
           'daily-current-user-transaction-report',
           'daily-transaction-report',       
           'gl-report'
           
        ];

        foreach ($permissions as $permission) {
            
            Permission::create(['name' => $permission, 'guard_name' => 'api']);
        }

    }
}
