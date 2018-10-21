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
            'admin',
            'moderate'
        ];

        // create permissions
        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // create roles and assign created permissions

        Role::create(['name' => 'admin']);

        $role = Role::create(['name' => 'moderator']);
        $role->givePermissionTo(['moderate']);

        $role = Role::create(['name' => 'Developer']);
        $role->givePermissionTo(Permission::all());
    }
}
