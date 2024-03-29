<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

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
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $user = User::factory()->create([
            'first_name' => 'Super Admin',
            'email' => 'admin@biyatransit.com',
            'password' => Hash::make('biyatransit@2023')
        ]);
        $role = Role::create(['name' => 'Super Admin']);
        $user->assignRole($role);

        // create permissions
        $tables = [
            'user', 'role', 'folder', 'customer', 'transporter', 'charge', 'invoice'
        ];

        foreach ($tables as $table) {
            $permissions = [];
            $permissions[0] = Permission::create(['name' => 'create-'.$table]); // créer | créer un ...
            $permissions[1] = Permission::create(['name' => 'read-'.$table]);   // voir | voir un ...
            $permissions[2] = Permission::create(['name' => 'update-'.$table]); // mettre à jour | édition de ...
            $permissions[3] = Permission::create(['name' => 'delete-'.$table]); // supprimer | suppression de ...
            //$permissions[4] = Permission::create(['name' => 'export-'.$table]); // exporter | exportation
        }
        Permission::create(['name' => 'add-ddi-opening']);
        Permission::create(['name' => 'add-exoneration']);
        Permission::create(['name' => 'add-declaration']);
        Permission::create(['name' => 'add-delivery-note']);
        Permission::create(['name' => 'add-delivery-details']);
        Permission::create(['name' => 'close-folder']);
        Permission::create(['name' => 'update-settings']);
        Permission::create(['name' => 'read-dashboard']);
/*
        Permission::create(['name' => 'edit articles']);
        Permission::create(['name' => 'delete articles']);
        Permission::create(['name' => 'publish articles']);
        Permission::create(['name' => 'unpublish articles']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'writer']);
        $role->givePermissionTo('edit articles');

        // or may be done by chaining
        $role = Role::create(['name' => 'moderator'])
            ->givePermissionTo(['publish articles', 'unpublish articles']);

        $role = Role::create(['name' => 'super-admin']);
        $role->givePermissionTo(Permission::all());
*/
    }
}
