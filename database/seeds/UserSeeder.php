<?php

use Illuminate\Database\Seeder;
use App\Traits\UuidManager;
use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use Spatie\Permission\Traits\HasRoles;

class UserSeeder extends Seeder
{
    use UuidManager;
    use HasRoles;
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        $type = $this->command->askWithCompletion('Enter type', ['ADMIN', 
        'CASHIER', 'MANAGER']);

        $role = Role::where('name', $type)->first();
        
        $user = User::create([
            'uuid' => UuidManager::generateUuid(),
            'first_name' => Str::random(8),
            'last_name' => Str::random(8),
            'email' => Str::random(10).'@gmail.com',
            'username' => Str::random(5),                  
            'password' => Hash::make('password'),
        ]);

        $user->assignRole($role);

        DB::table('employees')->insert([
            'user_id' => $user->id,
            'uuid' => UuidManager::generateUuid(),
            'branch_id' => 1,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'employee_no' => $user->username                            
        ]);          

    }
}
