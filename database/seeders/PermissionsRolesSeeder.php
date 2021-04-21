<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionsRolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions_array = [];

        $indexPostPermission = Permission::create(['name' => 'admin.posts.index']);
        array_push($permissions_array, $indexPostPermission);

        array_push($permissions_array, Permission::create(['name' => 'admin.posts.show']));
        array_push($permissions_array, Permission::create(['name' => 'admin.posts.create']));
        array_push($permissions_array, Permission::create(['name' => 'admin.posts.edit']));
        array_push($permissions_array, Permission::create(['name' => 'admin.posts.destroy']));

        array_push($permissions_array, Permission::create(['name' => 'admin.categories.index']));
        array_push($permissions_array, Permission::create(['name' => 'admin.categories.show']));
        array_push($permissions_array, Permission::create(['name' => 'admin.categories.create']));
        array_push($permissions_array, Permission::create(['name' => 'admin.categories.edit']));
        array_push($permissions_array, Permission::create(['name' => 'admin.categories.destroy']));

        array_push($permissions_array, Permission::create(['name' => 'admin.tags.index']));
        array_push($permissions_array, Permission::create(['name' => 'admin.tags.show']));
        array_push($permissions_array, Permission::create(['name' => 'admin.tags.create']));
        array_push($permissions_array, Permission::create(['name' => 'admin.tags.edit']));
        array_push($permissions_array, Permission::create(['name' => 'admin.tags.destroy']));

        array_push($permissions_array, Permission::create(['name' => 'admin.users.index']));
        array_push($permissions_array, Permission::create(['name' => 'admin.users.show']));
        array_push($permissions_array, Permission::create(['name' => 'admin.users.create']));
        array_push($permissions_array, Permission::create(['name' => 'admin.users.edit']));
        array_push($permissions_array, Permission::create(['name' => 'admin.users.destroy']));

        array_push($permissions_array, Permission::create(['name' => 'admin.roles.index']));
        array_push($permissions_array, Permission::create(['name' => 'admin.roles.show']));
        array_push($permissions_array, Permission::create(['name' => 'admin.roles.create']));
        array_push($permissions_array, Permission::create(['name' => 'admin.roles.edit']));
        array_push($permissions_array, Permission::create(['name' => 'admin.roles.destroy']));

        $superAdminRole = Role::create(['name' => 'Super_Admin']);
        $superAdminRole->syncPermissions($permissions_array);

        $viewIndexPostRole = Role::create(['name' => 'Lista_de_Post']);
        $viewIndexPostRole->givePermissionTo($indexPostPermission);
        
    }
}
