<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UsersPermissions extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissionsArray = [
            'add-user',
            'delete-user',
            'edit-user',
            'get users'
        ];

        $permissions = collect($permissionsArray)->map(function ($permissions) {
            return ['name'=>$permissions, 'guard_name' => 'api' ];
        });

        Permission::insert($permissions->toArray());

        Role::create(['name'=> 'admin', 'guard_name' => 'api'])->givePermissionTo(Permission::all());

        User::find(1)->assignRole('admin');
    }
}
