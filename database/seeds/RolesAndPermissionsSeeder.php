<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()['cache']->forget('spatie.permission.cache');

        $permissions = [
            'edit-thread',
            'delete-thread',
            'lock-thread',
            'unlock-thread',
            'pin-thread',
            'unpin-thread',
            'edit-reply',
            'delete-reply',
            'edit-user',
            'delete-user',
            'edit-role',
            'mark-best-reply'
        ];

        // create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign created permissions

        Role::create(['name' => 'admin']);

        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo(['edit-thread', 'delete-thread', 'edit-reply', 'delete-reply',
                                'mark-best-reply', 'lock-thread', 'unlock-thread']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
    }
}