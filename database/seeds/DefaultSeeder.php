<?php

use Illuminate\Database\Seeder;
use App\Traits\UuidManager;

class DefaultSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('branches')->insert([
            'code' => Str::random(6),
            'uuid' => UuidManager::generateUuid(),
            'name' => 'DEFAULT',
            'status' => 'ACTIVE'                           
        ]);       


        DB::table('roles')->insert(
            [          
                'name' => 'ADMIN',         
                'guard_name' => 'api',           
                                       
            ]
        );


        DB::table('roles')->insert(           
            [          
                'name' => 'CASHIER',         
                'guard_name' => 'api',        
                                       
            ]
        );

        DB::table('roles')->insert(           
            [          
                'name' => 'MANAGER',         
                'guard_name' => 'api',    
            ]
        );


        DB::table('gl_account_types')->insert(
            [
                'uuid' => UuidManager::generateUuid(),
                'title'=> ucfirst(strtolower('INCOME')),
                'type' => 'INCOME',
                'sort_order'=>1,
                'description'=>'',
            ]
        );

        DB::table('gl_account_types')->insert(
            [
                'uuid' => UuidManager::generateUuid(),
                'title'=> ucfirst(strtolower('EXPENSE')),
                'type' => 'EXPENSE',
                'sort_order'=>2,
                'description'=>'',
            ]
        );

        DB::table('gl_account_types')->insert(
            [
                'uuid' => UuidManager::generateUuid(),
                'title'=> ucfirst(strtolower('ASSETS')),
                'type' => 'ASSETS',
                'sort_order'=>3,
                'description'=>'',
            ]
        );        

        DB::table('gl_account_types')->insert(
            [
                'uuid' => UuidManager::generateUuid(),
                'title'=> ucfirst(strtolower('LIABILITY')),
                'type' => 'LIABILITY',
                'sort_order'=>4,
                'description'=>'',
            ]
        );

        DB::table('gl_account_types')->insert(
            [
                'uuid' => UuidManager::generateUuid(),
                'title'=> ucfirst(strtolower('EQUITY')),
                'type' => 'EQUITY',
                'sort_order'=>5,
                'description'=>'',
            ]
        );
    }
}
